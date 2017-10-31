<?php

use Illuminate\Http\Request;
use App\Country;
use App\State;
use App\City;

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

Route::get('countries', function() {
    return response()->json(Country::all()); 
});

Route::get('countries/{id}', function($id) {
    return response()->json(Country::find($id));
});

Route::get('countries/{id}/states', function($id) {
    return response()->json(Country::find($id)->states);
});


Route::get('states', function() {
    return response()->json(State::all()); 
});

Route::get('states/{id}', function($id) {
    return response()->json(State::find($id));
});

Route::get('states/{id}/cities', function($id) {
    return response()->json(State::find($id)->cities);
});


Route::get('cities', function() {
    return response()->json(City::all()); 
});

Route::get('cities/{id}', function($id) {
    return response()->json(City::find($id));
});