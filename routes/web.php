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

use App\Jobs\DownloadResource;

Route::get('/', function () {

    DownloadResource::dispatch('https://wpmag-22.cdn.pjtsu.com/wp-content/uploads/sites/13/2013/11/google-maps-wordpress.png?w=780');

    return view('welcome');
});
