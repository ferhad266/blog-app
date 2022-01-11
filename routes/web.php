<?php

use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\UserController;

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
    return view('welcome');
});

Route::middleware(['admin'])->group(function () {
    Route::prefix('admin/settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.Index');
        Route::post('', [SettingsController::class, 'sortable'])->name('settings.Sortable');
        Route::get('/delete/{id}', [SettingsController::class, 'destroy']);
        Route::get('/edit/{id}', [SettingsController::class, 'edit'])->name('settings.Edit');
        Route::post('/{id}', [SettingsController::class, 'update'])->name('settings.Update');
    });
});


Route::group(['prefix' => 'admin'], function () {

    Route::middleware(['admin'])->group(function () {

        //Blog
        Route::resource('blog', 'Backend\BlogController');
        Route::post('/blog/sortable', [BlogController::class, 'sortable'])->name('blog.Sortable');

        //Page
        Route::resource('page', 'Backend\PageController');
        Route::post('/page/sortable', [PageController::class, 'sortable'])->name('page.Sortable');

        //Slider
        Route::resource('slider', 'Backend\SliderController');
        Route::post('/slider/sortable', [SliderController::class, 'sortable'])->name('slider.Sortable');

        //Slider
        Route::resource('user', 'Backend\UserController');
        Route::post('/user/sortable', [UserController::class, 'sortable'])->name('user.Sortable');

        //Auth
        Route::get('/dashboard', [DefaultController::class, 'index'])->name('admin.Index')->middleware('admin');
        Route::get('/', [DefaultController::class, 'login'])->name('admin.Login');
        Route::post('/login', [DefaultController::class, 'authenticate'])->name('admin.Auth');
        Route::get('/logout', [DefaultController::class, 'logout'])->name('admin.Logout');

    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
