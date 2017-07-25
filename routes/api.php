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

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api){

    $api->get('test', function () {
        return 'It is ok';
    });
//    $api->resource('lesson', '\App\Http\Controllers\LessonController');
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
//        $api->get('lesson', 'LessonController@index');
        $api->post('user/login', 'AuthController@authenticate');
        $api->post('user/register', 'LessonController@register');
        $api->group(['middleware' => 'jwt.auth'], function ($api) {

            $api->get('lesson', 'LessonController@index');
            $api->get('lesson/{id}','LessonController@show');
        });
    });

});