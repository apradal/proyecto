<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class FormsController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Check the inputs and register the user if doesnt exists
     */
    public function submitRegisterUser(Request $request){

        //create new user
        $user = new User;

        //validates the data (includes check if email already exists in db)
        $validator = Validator::make($request->all(),
        [
            'email' => 'unique:users|required|email',
            'password' => 'required',
            'name' => 'required',
            'lastName' => 'required',
            'provinces' => 'required'
        ],
        [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'La dirección de correo no es una dirección válida.',
            'email.unique' => 'La dirección de correo ya existe.',
            'password.required' => 'La contraseña es obligatoria.',
            'name.required' => 'El nombre es obligatorio.',
            'lastName.required' => 'El apellido es obligatorio.',
            'provinces.required' => 'La provincia es obligatoria.'
        ]);

        //if something is wrong
        if ($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()->toArray(),
                'success' => false
            ], 422);

        } else {

            //insert user
            $user->nombre = $request->input('name');
            $user->apellidos = $request->input('lastName');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->provincia = $request->input('provinces');
            $user->fecha_registro = date('Y-m-d');

            //save user
            if($user->save()){

                //send succdess to ajax
                return response()->json(['success' => true], 200);

            };

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * log the user and make him auth.
     */
    public function submitLoginUser(Request $request){

        //validates the data (includes check if email already exists in db)
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Introduzca email.',
            'email.email' => 'La dirección de correo no es una dirección válida.',
            'password.required' => 'Introduzca contraseña.',
        ]);

        if ($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()->toArray(),
                'success' => false
            ], 422);
        } else {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                // Authentication passed...
                //creates the user autenticated
                $user = Auth::user();
                //make him login so i can access the data on views.
                Auth::login($user);
                if ($user->email === 'admin@proyecto.com') {
                    return response()->json(['success' => true, 'admin' => true], 200);
                } else {
                    return response()->json(['success' => true, 'admin' => false], 200);
                }
            } else {
                return $this->checkUserExists($request);
            }
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     * check users and send message to ajax
     */
    protected function checkUserExists($request){

        $user = new User;
        $userExist = $user->where('email', '=', $request->input('email'))->first();

        if ($userExist === null) {
            // user doesn't exist
            return response()->json(['errors' => ['register' => 'Este correo no está registrado.'],'success' => false], 422);
        } else {
            //check password coincidence
            if (Hash::check( $request->input('password'), $userExist->password)){
                //send success to ajax
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['errors' => ['coincidence' => 'La contraseña no coincide.'],'success' => false], 422);
            }

        }

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * User logout and redirect to main
     */
    public function submitLogoutUser(){

        Auth::logout();

        return redirect()->intended('/');

    }

}
