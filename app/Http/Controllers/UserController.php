<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 18/11/2017
 * Time: 12:44
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Activity;

class UserController extends Controller
{
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
    protected $types = [
        'Deportes',
        'Didáctica',
        'Hostelería',
        'Ocio',
        'Viajes',
        'Otros'
    ];
    protected $data;

    public function getIndex()
    {
        if (Auth::user()){
            $user = User::find(Auth::id());
            $activites = $user->activities()->orderBy('fecha_inicio', 'DESC')->limit('6')->get();
            \App\Http\Middleware\Utils::addUserRole($user,$activites);
            return view('userpanel',['provinces' => $this->provinces, 'user' => $user, 'activities' => $activites]);
        }
        return view('userpanel',['provinces' => $this->provinces]);
    }

    public function changeUserData(Request $request)
    {
        $user = User::find(Auth::id());
        if ($user->email == $request->input('email')){
            $inputs = [
                'email' => 'required|email',
                'nombre' => 'required',
                'apellidos' => 'required',
                'provincia' => 'required'
            ];
            $messages = [
                'email.required' => 'El email es obligatorio.',
                'email.email' => 'La dirección de correo no es una dirección válida.',
                'nombre.required' => 'El nombre es obligatorio.',
                'apellidos.required' => 'El apellido es obligatorio.',
                'provincia.required' => 'La provincia es obligatoria.'
            ];
        } else {
            $inputs = [
                'email' => 'unique:users|required|email',
                'nombre' => 'required',
                'apellidos' => 'required',
                'provincia' => 'required'
            ];
            $messages = [
                'email.required' => 'El email es obligatorio.',
                'email.email' => 'La dirección de correo no es una dirección válida.',
                'email.unique' => 'La dirección de correo ya existe.',
                'nombre.required' => 'El nombre es obligatorio.',
                'apellidos.required' => 'El apellido es obligatorio.',
                'provincia.required' => 'La provincia es obligatoria.'
            ];
        }

        //validates the data (includes check if email already exists in db)
        $validator = Validator::make($request->all(),
        $inputs, $messages);

        //if something is wrong
        if ($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'success' => false
            ], 422);
        } else {
            //change data user
            $data = $this->getDataChanges($request->all(), $user);
            $this->updateUserData($data, $user);
            //send succdess to ajax
            return response()->json(['success' => true], 200);
        }
    }

    protected function getDataChanges($dataUser, $user)
    {
        unset($dataUser['_token']);
        if ($dataUser['password'] == null) unset($dataUser['password']);
        $changedData = array();
        foreach ($dataUser as $key => $value) if ($value != $user->$key) $changedData[$key] = $value;
        return $changedData;
    }

    protected function updateUserData($data, $user)
    {
        //asi evito que en el foreach compruebe si existe el campo password por cada each.
        if (isset($data['password']) && $data['password'] != null && strlen(trim($data['password'])) > 0) {
            $user->password = Hash::make($data['password']);
            unset($data['password']);
        }
        foreach ($data as $key => $value) $user->$key = $value;
        //save user
        $user->save();

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

    public function getUsers(Request $request)
    {
        $users = $this->queryBuilder($request);
        if (isset($users)) {
            $html = \View::make("includes.usersAdmin", compact('users'))->render();
        } else {
            $html = '<span>No existen actividades con estos filtros.</span>';
        }
        return $html;
    }

    protected function queryBuilder($request){
        $this->data = $request->all();
        unset($this->data['search']);
        foreach ($this->data as $key => $value) {
            if ($value === null) unset($this->data[$key]);
        }
        if (count($this->data) > 0) {
            $data = $this->buildParamsQuery();
            return User::where($data)->get();
        }
        return null;
    }

    protected function buildParamsQuery()
    {
        $data = array();
        foreach ($this->data as $key => $value) {
            $data[] = [$key, '=', $value];
        }
        return $data;
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        if ($id != null) {
            $user = User::find($id);
            $this->deleteUserActivities($user);
            if ($user->delete()) {
                return redirect('/admin')->with('message', 'Usuario eliminado!');
            } else {
                return redirect('/admin')->withErrors('No se ha eliminado el usuario.')->withInput();
            }
        }
    }

    protected function deleteUserActivities($user)
    {
        $activities = $user->activities;
        foreach ($activities as $activity) {
            $activity->delete();
        }
    }
}