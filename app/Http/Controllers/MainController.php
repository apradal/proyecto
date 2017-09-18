<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('home')->with('provinces' , $provinces);

    }

}
