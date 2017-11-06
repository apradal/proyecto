<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    //all types of activities
    protected $types = [
        'Deportes',
        'Didáctica',
        'Hostelería',
        'Ocio',
        'Viajes',
        'Otros'
    ];
    //all provinces of Spain
    protected $provinces = [
        'Albacete',
        'Alicante',
        'Almería',
        'Asturias',
        'Álava',
        'Ávila',
        'Badajoz',
        'Bacerlona',
        'Baleares',
        'Bizkaia',
        'Burgos',
        'Cáceres',
        'Cádiz',
        'Cantabria',
        'Castellón',
        'Ciudad Real',
        'Ceuta',
        'Córdoba',
        'Cuenca',
        'Gipuzkoa',
        'Girona',
        'Granada',
        'Guadalajara',
        'Huelva',
        'Huesca',
        'Jaén',
        'La Coruña',
        'La Rioja',
        'Las Palmas',
        'León',
        'Lleida',
        'Lugo',
        'Madrid',
        'Málaga',
        'Melilla',
        'Murcia',
        'Navarra',
        'Ourense',
        'Palencia',
        'Pontevedra',
        'Salamanca',
        'Santa Cruz de Tenerife',
        'Segovia',
        'Sevilla',
        'Soria',
        'Tarragona',
        'Teruel',
        'Toledo',
        'Valencia',
        'Valladolid',
        'Zamora',
        'Zaragoza'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * call the main web passing the activities to be shown
     */
    public function getIndex(){

        $activities = $this->firstActivityBuild();

        return view('home', ['provinces' => $this->provinces, 'activities' => $activities, 'types' => $this->types]);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     * gets all the activities from the same province as user logged.
     */
    protected function firstActivityBuild()
    {
        if (Auth::check()){
            return Activity::where('provincia', '=', ucfirst(Auth::user()->provincia))->get();
        } else {
            return Activity::all();
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * returns the html rendered by filter options
     */
    public function buildQueryActivity(Request $request){
        $activities = $this->queryBuilder($request);
        $html = \View::make("includes.activities", compact('activities'))->render();
        return $html;
    }

    protected function queryBuilder($request){
        $province = $request->input('province');
        $type = $request->input('type');
        $date = $request->input('date');

        //si todos tienen valor
        if ($province != null && $type != null && $date != null) return Activity::where([
            ['provincia', '=', $province],
            ['tipo', '=', $type],
            ['fecha_inicio', '=', $date]
        ])->get();
        //todas las posibilidades de provincia not null y lo demas si.
        if ($province != null && $type != null && $date == null) return Activity::where([
            ['provincia', '=', $province],
            ['tipo', '=', $type]
        ])->get();
        if ($province != null && $type == null && $date != null) return Activity::where([
            ['provincia', '=', $province],
            ['fecha_inicio', '=', $date]
        ])->get();
        if ($province != null && $type == null && $date == null) return Activity::where('provincia', '=', $province)->get();
        //todas las posibilidades de tipo not null y lo demas si.
        if ($province == null && $type != null && $date != null) return Activity::where([
            ['tipo', '=', $type],
            ['fecha_inicio', '=', $date]
        ])->get();
        if ($province != null && $type != null && $date == null) return Activity::where([
            ['provincia', '=', $province],
            ['tipo', '=', $type]
        ])->get();
        if ($province == null && $type != null && $date == null) return Activity::where('tipo', '=', $type)->get();
        //todas las posibilidades de fecha not null y los demas si.
        if ($province == null && $type == null && $date != null) return Activity::where('fecha_inicio', '=', $date)->get();
        //si todos esta null es que se ha pulsado el boton reset
        if ($province == null && $type == null && $date == null) return Activity::all();

    }

    /**
     *
     * calls create activity page
     */
    public function createActivity(){

        return view('createactivity')->with(['provinces' => $this->provinces, 'types' => $this->types]);

    }

    public function pruebas(){

        $user = new User();
        $activity = new Activity();

        //saca el usuario con nombre antonio
        //$user = $user->where('nombre', '=', 'antonio')->first();
        //saca la actividad con id 1
        $activity = $activity->find(1);
        //saca los usuarios que tienen id 1 de actividad
        //$user = $activity->find(1)->users;
        $x = array();
        //SACA TODOS LOS USUARIOS REGISTRADOS A ESTA ACTIVIDAD
        foreach ($activity->users as $user){
            $x[] = $user->id;
        }

        return $x;
    }

}
