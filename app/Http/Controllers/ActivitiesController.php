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
            'endDate' => 'nullable|date',
            'types' => 'required',
            'provinces' => 'required',
            'poblation' => 'required',
            'street' => 'required',
            'startHour' => array(
                'required',
                'regex:/^(([0-1][0-9]|2[0-3]):[0-5][0-9])$/'
            ),
            'endHour' => array(
                'nullable',
                'regex:/^(([0-1][0-9]|2[0-3]):[0-5][0-9])$/'
            ),
            'description' => 'required'
        ],
        [
            'title.required' => 'El título es obligatorio.',
            'startDate.required' => 'La fecha de inicio es obligatoria.',
            'startDate.date' => 'La fehca de inicio debe ser formato fecha',
            'endDate.date' => 'La fehca fin debe ser formato fecha.',
            'types.required' => 'El tipo de actividad es obligatorio.',
            'provinces.required' => 'La provincia es obligatoria.',
            'poblation.required' => 'La población es obligatoria.',
            'street.required' => 'La dirección es obligatoria.',
            'startHour.required' => 'La hora de incio es obligatoria.',
            'startHour.timezone' => 'La hora de inicio debe ser formato horas.',
            'endHour.timezone' => 'La hora fin debe ser formato horas.',
            'description.required' => 'La descripción es obligatoria.',
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

}