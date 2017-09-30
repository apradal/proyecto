<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 23/09/2017
 * Time: 11:05
 */

namespace App\Http\Controllers;

use App\ActivityUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Activity;


class ActivitiesController
{

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

            //save activity and create the relationship
            if($activity->save()){
                $this->createRelation(Auth::id(), $activity->id);
                return redirect('/')->with('message', 'Actividad creada!');
            };
        }
    }

    private function createRelation($user_id, $activity_id){
        $relation = new ActivityUser;
        $relation->user_id = $user_id;
        $relation->activity_id = $activity_id;
        $relation->user_role = 'creador';
        $relation->save();
    }

}