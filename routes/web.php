<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MasterControler;
use App\Http\Controllers\HomeController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('API/{control}/{action}', [MasterControler::class, 'getFunc']);

Route::post('controler/{control}/{action}', [MasterControler::class, 'getFunc']);

Route::get('view/{control}/{action}', [MasterControler::class, 'getFunc']);

Route::get('/', [MasterControler::class, 'getFunc']);


//Route::get('/{teste}', function($teste){
//    return view('{teste}');
//});

