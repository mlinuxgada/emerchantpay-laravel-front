<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RssUrlController;
use App\Http\Controllers\RssItemController;

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
    return view('home');
});

Route::resource('rss_urls', RssUrlController::class);
Route::resource('rss_items', RssItemController::class);
