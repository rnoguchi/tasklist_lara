<?php

use Illuminate\Http\Request;
use App\Model\Tasks;

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

Route::group(['middleware' => 'client', 'namespace' => 'api'], function() {
    Route::get('/tasks',  function() {
        $tasks = Tasks::all();
        return $tasks;
    });
    Route::post('/tasks/create',  'TaskController@save');
});
