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

$router = app('Dingo\Api\Routing\Router');
//'middleware'=>'api.auth',
$router->version('v1', ['namespace' => 'App\Http\Controllers\Api'], function ($api) {
    include __DIR__ . '/version1.php';
});