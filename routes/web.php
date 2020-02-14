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

use App\Helpers\MultiLineStrPad;

Route::get('/tasks/1', function (MultiLineStrPad $multiLineStrPad) {
    return $multiLineStrPad->strPad("blah\nblah", 3);
});

Route::get('/tasks/2', function (\App\Helpers\GreatestProduct $greatestProduct) {
    return $greatestProduct->find([1, 5, 3, 9, 7, 0, 3]);
});


Route::get('/tasks/3', function () {
    $throttle = new \App\Helpers\Throttle('foo', 10);
    $throttle->attempt();

    return response()->json([
        'remainingAttempts' => $throttle->calculateRemainingAttempts()
    ]);
});
