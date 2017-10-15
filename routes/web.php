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

/** ACTIVITY STUFF **/
//es llamado por un hiperlink, tiene que ser get. {{ url('/createactivity') }}.
Route::get('/createactivityform', 'MainController@createActivity');
Route::get('/createactivty', 'ActivitiesController@create');
Route::post('/joinactivity', 'ActivitiesController@join');
Route::post('/leaveactivity', 'ActivitiesController@leave');

/** TEST STUFF */
Route::get('/prueba', 'MainController@pruebas');


