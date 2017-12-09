<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 23/09/2017
 * Time: 11:05
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Middleware\Utils;
use App\Activity;


class ActivitiesController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Saves on the DB the activitie and the association
     */
    public function create(Request $request){
        //create new activity model
        $activity = new Activity;
        //validates the data (includes check if email already exists in db)
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'types' => 'required',
            'provinces' => 'required',
            'poblation' => 'required',
            'street' => 'required',
            'startHour' => array(
                'required',
                'regex:/^(([0-1][0-9]|2[0-3]):[0-5][0-9])$/'
            ),
            'endHour' => array(
                'required',
                'regex:/^(([0-1][0-9]|2[0-3]):[0-5][0-9])$/'
            ),
            'description' => 'required',
            'participants' => 'required',
        ],
        [
            'title.required' => 'El título es obligatorio.',
            'startDate.required' => 'La fecha de inicio es obligatoria.',
            'startDate.date' => 'La fehca de inicio debe ser formato fecha',
            'endDate.required' => 'La fecha din es obligatoria',
            'endDate.date' => 'La fehca fin debe ser formato fecha.',
            'types.required' => 'El tipo de actividad es obligatorio.',
            'provinces.required' => 'La provincia es obligatoria.',
            'poblation.required' => 'La población es obligatoria.',
            'street.required' => 'La dirección es obligatoria.',
            'startHour.required' => 'La hora de incio es obligatoria.',
            'startHour.timezone' => 'La hora de inicio debe ser formato horas.',
            'endHour.required' => 'La hora fin es obligatoria',
            'endHour.timezone' => 'La hora fin debe ser formato horas.',
            'description.required' => 'La descripción es obligatoria.',
            'participants.required' => 'Debe indicar el número máximo de participantes',
        ]);

        //if something is wrong
        if ($validator->fails()){
            return redirect('/createactivityform')->withErrors($validator)->withInput();
        } else {
            //insert activity
            $activity->titulo = $request->input('title');
            $activity->descripcion = $request->input('description');
            $activity->fecha_inicio = $request->input('startDate');
            $activity->fecha_fin = $request->input('endDate');
            $activity->tipo = $request->input('types');
            $activity->estado = 'activa';
            $activity->provincia = $request->input('provinces');
            $activity->poblacion = $request->input('poblation');
            $activity->direccion = $request->input('street');
            $activity->hora_inicio = $request->input('startHour');
            $activity->hora_fin = $request->input('endHour');
            $activity->id_creator = Auth::id();
            $activity->num_participantes = 1;
            $activity->max_participantes = $request->input('participants');

            //save activity and create the relationship
            if($activity->save()){
                $this->createRelation($activity, 'creador');
//                //busco usuario con la id actual
//                $user = User::where('id', Auth::id())->first();
//                //aqui hago que inserte la relación en la tabla.
//                $user->activities()->attach($activity->id);
//                //a mano updateo la tabla para decir que es creador.
//                DB::table('activity_user')
//                    ->where(['user_id' => $user->id, 'activity_id' => $activity->id])
//                    ->update(['user_role' => 'creador']);
                return redirect('/')->with('message', 'Actividad creada!');
            };
        }
    }

    /**
     * @param $activity
     * @param $role
     * @return bool
     * register the user with the activity
     */
    protected function createRelation($activity, $role){
        //busco usuario con la id actual
        $user = User::where('id', Auth::id())->first();
        //aqui hago que inserte la relación en la tabla.
        $user->activities()->attach($activity->id);
        //a mano updateo la tabla para decir que es creador.
        DB::table('activity_user')
            ->where(['user_id' => $user->id, 'activity_id' => $activity->id])
            ->update(['user_role' => $role]);
        return true;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Join the user to an Activity.
     */
    public function join(Request $request){
        $activityId = $request->input('activityId');
        $activity = Activity::where('id', $activityId)->first();
        $activity->num_participantes += 1;
        $activity->save();
        if($this->createRelation($activity, 'participante')){
            return response()->json(['success' => true], 200);
        } else {
            return response()->json([
                'errors' => 'Error al unirse a esta actidivad.',
                'success' => false
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Leave the Activity
     */
    public function leave(Request $request){
        $activityId = $request->input('activityId');
        $activity = Activity::where('id', $activityId)->first();
        $activity->num_participantes -= 1;
        $activity->save();
        if ( DB::table('activity_user')
            ->where(['user_id' => Auth::id(), 'activity_id' => $activityId])
            ->delete()){
            return response()->json(['success' => true], 200);
        } else {
            return response()->json([
                'errors' => 'Error al salir de esta actidivad.',
                'success' => false
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Deletes the activity and all the data relation with.
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $validator = Validator::make($request->all(),[
            'comment-admin' => 'required',
        ],
        [
            'comment-admin.required' => 'Debe indicar el motivo.',
        ]);
        if ($validator->fails()) {
            $error = array();
            $errors = $validator->errors()->messages();
            foreach ($errors as $err => $value) {
                foreach ($value as $val) {
                    $error[] = $val;
                }
            }
            return response()->json([
                'errors' => $error,
                'success' => false
            ], 422);
        }
        $activity = Activity::find($id);
        if ($activity->delete()){
            if (Auth::user()->email === 'admin@proyecto.com') {
                return response()->json(['success' => true, 'admin' => true], 200);
            } else {
                return response()->json(['success' => true, 'admin' => false], 200);
            }
        } else {
            return response()->json([
                'errors' => 'Error al eliminar esta actidivad.',
                'success' => false
            ], 422);
        }
    }

    public function edit(Request $request)
    {
        $inputs = $request->all();
        $rules = [
            'titulo' => 'required',
            'poblacion' => 'required',
            'direccion' => 'required',
            'max_participantes' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required|gtdate',
            'hora_inicio' => array(
                'required',
                'regex:/^(([0-1][0-9]|2[0-3]):[0-5][0-9])$/'
            ),
            'hora_fin' => array(
                'required',
                'gt',
                'regex:/^(([0-1][0-9]|2[0-3]):[0-5][0-9])$/'
            ),
            'descripcion' => 'required',
            'comment-admin' => 'required',
        ];
        $messages = [
            'titulo.required' => 'El título es obligatorio.',
            'poblacion.required' => 'La población es obligatoria.',
            'direccion.required' => 'La dirección es obligatoria',
            'max_participantes.required' => 'El máximo de usuarios es obligatorio.',
            'fecha_inicio.required' => 'La fecha inicio es obligatoria.',
            'fecha_fin.required' => 'La fecha fin es obligatoria.',
            'hora_inicio.required' => 'La hora de incio es obligatoria.',
            'hora_inicio.timezone' => 'La hora de inicio debe ser formato horas.',
            'hora_fin.required' => 'La hora fin es obligatoria',
            'hora_fin.timezone' => 'La hora fin debe ser formato horas.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'comment-admin.required' => 'Debe indicar un comentario',
            'hora_fin.gt' => 'La hora fin debe ser mayor que la hora inicial',
            'fecha_fin.gtdate' => 'La fecha fin no puede ser menor que la inicial',
        ];
        /* EXTENSION TO CALCULATE GTS AND LTS */
        Validator::extend('gt', function(){
            $end = $_REQUEST['hora_fin'];
            $start = $_REQUEST['hora_inicio'];
            return Utils::gtTime($end, $start);
        });
        Validator::extend('gtdate', function(){
            $end = $_REQUEST['fecha_fin'];
            $start = $_REQUEST['fecha_inicio'];
            return Utils::gtDate($end, $start);
        });
        $validator = Validator::make($inputs,$rules,$messages);
        if ($validator->fails()){
            return redirect('/activityadmin?id='.$request->id)->withErrors($validator)->withInput();
        } else {
            if($this->update($request)) {
                if (Auth::user()->email === 'admin@proyecto.com') {
                    return redirect('/admin')->with('message', 'Actividad editada!');
                } else {
                    return redirect('/userpanel')->with('message', 'Actividad editada!');
                }
            }
        }
    }

    public function update($request)
    {
        $id = $request->id;
        $parameters = $request->all();
        unset($parameters['comment-admin']);
        unset($parameters['edit']);
        $activity = Activity::find($id);
        $activity->update($parameters);
        return $activity->save();
    }
}