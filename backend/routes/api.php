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

Auth::routes([
    'verify'   => false,
    'register' => true,
    'reset'    => false,
    'confirm'  => false
]);

Route::get('/hoge', function (Request $request) {
    return [
        'result' => \App\User::all()
    ];
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/identity', 'IdentityController');
});
