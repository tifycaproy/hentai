<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('registro', 'api\UsuarioController@registro');

Route::post('ingresar', 'api\UsuarioController@iniciar');
Route::post('cambiar', 'api\UsuarioController@cambiar');
Route::post('validar', 'api\UsuarioController@validar_pin');
Route::get('perfil', 'api\UsuarioController@perfil');
Route::post('reenviar_pin','api\UsuarioController@reenviar_pin');
Route::get('consulta_videos', 'api\VideosController@consulta_video');
Route::post('add_favorito','api\VideosController@add_favorito');
Route::post('bloqueo','api\VideosController@bloqueo');
Route::post('add_tarde','api\VideosController@add_tarde');
Route::get('del_favorito','api\VideosController@del_favorito');
Route::get('del_tarde','api\VideosController@del_tarde');

Route::post('add_dowl','api\VideosController@add_dowl');
Route::get('cons_favorito', 'api\VideosController@cons_favorito');
Route::get('cons_tarde', 'api\VideosController@cons_tarde');
Route::get('historial', 'api\VideosController@cons_dowl');
//Route::get('mostrar/idpost','api\VideosController@buscar');
Route::get('mostrar/{id}', 'api\VideosController@buscar');
