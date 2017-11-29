<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** INDEX **/
Route::get('/', 'MainController@getIndex');
Route::get('/buildactivity', 'MainController@buildQueryActivity');

/** USER STUFF **/
Route::post('/registeruser', 'FormsController@submitRegisterUser');
Route::post('/loginuser', 'FormsController@submitLoginUser');
Route::post('/logoutuser', 'FormsController@submitLogoutUser');
Route::get('/userpanel', 'UserController@getIndex');
Route::post('/personaldata', 'UserController@changeUserData');

/** ACTIVITY STUFF **/
//es llamado por un hiperlink, tiene que ser get. {{ url('/createactivity') }}.
Route::get('/createactivityform', 'MainController@createActivity');
Route::get('/createactivty', 'ActivitiesController@create');
Route::post('/joinactivity', 'ActivitiesController@join');
Route::post('/leaveactivity', 'ActivitiesController@leave');

/** TEST STUFF */
Route::get('/prueba', 'MainController@pruebas');

/* TODO: Aquí apunto todo lo que tengo pendiente de hacer
    sección admin, eliminar actividades, editar actividades, eliminar users.
    añadir campo mensaje cierre a la actividad. (hecho) para indicar cierre por finalización o por el admin etc. (falta hacer el migrate y la funcionalidad)
    tb mostrar el mensaje en las finalizadas en userpanel.
    redirect / una vez registrado
*/
