<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;

class MainController extends Controller
{

    public function getIndex(){

        //all provinces of Spain
        $provinces = [

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

        return view('home')->with('provinces', $provinces);

    }

    public function createActivity(){

        //all provinces of Spain
        $provinces = [

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

        $types = [

            'Deportes',
            'Didáctica',
            'Hostelería',
            'Ocio',
            'Viajes',
            'Otros'

        ];

        return view('createactivity')->with(['provinces' => $provinces, 'types' => $types]);

    }

    public function pruebas(){

        $user = new User();
        $activity = new Activity();

        //saca el usuario con nombre antonio
        //$user = $user->where('nombre', '=', 'antonio')->first();
        //saca el usuario con id 1
        $activity = $activity->find(1);
        //saca los usuarios que tienen id 1 de actividad
        //$user = $activity->find(1)->users;
        return $activity;

    }

}
