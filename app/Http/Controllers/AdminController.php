<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 04/12/2017
 * Time: 19:43
 */

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
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
    protected $states = [
        'activa',
        'finalizada'
    ];
    protected $data;

    public function getIndex()
    {
        return view('admin', ['types' => $this->types]);
    }

    /**
     * @param Request $request
     * @return mixed
     * Return the rendered data of all activites filtered.
     */
    public function getActivities(Request $request)
    {
        $activities = $this->queryBuilder($request);
        if (isset($activities)) {
            $html = \View::make("includes.activitiesAdmin", compact('activities'))->render();
        } else {
            $html = '<span>No existen actividades con estos filtros.</span>';
        }
        return $html;
    }

    protected function queryBuilder($request){
        $this->data = $request->all();
        unset($this->data['search']);
        if (isset($this->data['id_creator'])) {
            $this->convertMailUserToId();
        }
        foreach ($this->data as $key => $value) {
            if ($value === null) unset($this->data[$key]);
        }
        if (count($this->data) > 0) {
            $data = $this->buildParamsQuery();
            return Activity::where($data)->get();
        }
        return null;
    }

    protected function convertMailUserToId()
    {
        $user = User::where([['email', '=', $this->data['id_creator']]])->first();
        if ($user != null) {
            $this->data['id_creator'] = $user->id;
        } else {
            $this->data['id_creator'] = null;
        }
    }

    protected function buildParamsQuery()
    {
        $data = array();
        foreach ($this->data as $key => $value) {
            if ($key === 'fecha_inicio') {
                $data[] = [$key, '>=', $value];
            } elseif ($key === 'fecha_fin'){
                $data[] = [$key, '<=', $value];
            } else {
                $data[] = [$key, '=', $value];
            }
        }
        return $data;
    }

    public function getActivityIndex(Request $request)
    {
        $activity = $this->getActivity($request->id);
        $creator = null;
        $users = $activity->users;
        foreach ($users as $key => $value) {
            if ($value->id == $activity->id_creator){
                $creator = $value;
                $users->forget($key);
            }
        }
        return view('activities', [
            'activity' => $activity,
            'types' => $this->types,
            'provinces' => $this->provinces,
            'states' => $this->states,
            'users' => $activity->users,
            'creator' => $creator]);
    }

    protected function getActivity($id)
    {
        return Activity::find($id);
    }
}