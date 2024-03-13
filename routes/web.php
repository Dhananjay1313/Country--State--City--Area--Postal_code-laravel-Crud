<?php

use App\Http\Controllers\Areacontroller;
use App\Http\Controllers\Citycontroller;
use App\Http\Controllers\Countrycontroller;
use App\Http\Controllers\Fetchcontroller;
use App\Http\Controllers\Postalcontroller;
use App\Http\Controllers\Statecontroller;
use App\Http\Controllers\Storecontroller;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('data');
});

Route::get('/country', function () {
    return view('country');
});

Route::get('/state', function () {
    return view('state');
});

Route::get('/city', function () {
    return view('city');
});

Route::get('/area', function () {
    return view('area');
});

Route::get('/postal', function () {
    return view('postal');
});

Route::post('/addcountry', [Countrycontroller::class,'save']);

Route::get('/listcountry', [Countrycontroller::class,'index']);

Route::get('/editcountry', [Countrycontroller::class, 'get']);

Route::post('/deletecountry', [Countrycontroller::class, 'delete']);

Route::post('/addstate', [Statecontroller::class, 'save']);

Route::get('/liststate',[Statecontroller::class,'index']);

Route::get("/editstate",[Statecontroller::class,'get']);

Route::post('/deletestate',[Statecontroller::class,'delete']);

Route::post('/addcity',[Citycontroller::class,'save']);

Route::get('/listcity',[Citycontroller::class,'index']);

Route::get('/editcity',[Citycontroller::class,'get']);

Route::post('/deletecity',[Citycontroller::class,'delete']);

Route::post('/addarea',[Areacontroller::class,'save']);

Route::get("/listarea",[Areacontroller::class,'index']);

Route::get('/editarea',[Areacontroller::class,'get']);

Route::post('/deletearea',[Areacontroller::class,'delete']);

Route::post('/addpostal',[Postalcontroller::class,'save']);

Route::get('/listpostal',[Postalcontroller::class,'index']);

Route::get('/editpostal',[Postalcontroller::class,'get']);

Route::post('/deletepostal',[Postalcontroller::class,'delete']);

Route::post('/store-country',[Statecontroller::class,'storeCountry'])->name('storeCountry');

Route::get('/state',[Statecontroller::class,'getState'])->name('state');

Route::post('/store-state',[Citycontroller::class,'storeState'])->name('storeState');

Route::get('/city',[Citycontroller::class,'getCity'])->name('city');

Route::post('/store-city',[Areacontroller::class,'storeCity'])->name('storeCity');

Route::get('/area',[Areacontroller::class,'getArea'])->name('area');

Route::post('/store-area',[Postalcontroller::class,'storeArea'])->name('storeArea');

Route::get('/postal',[Postalcontroller::class,'getPostal'])->name('postal');

Route::get('/fetch-states', [Fetchcontroller::class,'fetchStates']);

Route::get('/fetch-city',[Fetchcontroller::class,'fetchCity']);

Route::get('/fetch-area',[Fetchcontroller::class,'fetchArea']);