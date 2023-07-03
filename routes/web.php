<?php

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
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    //////////////////////////Personal////////////////////////////////
    Route::get('personal', [App\Http\Controllers\Admin\PersonalController::class, 'index']);
    Route::get('fetch-personal', 'App\Http\Controllers\Admin\PersonalController@fetch_personal');
    Route::post('store-personal', [App\Http\Controllers\Admin\PersonalController::class, 'store']);
    Route::delete('delete-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'delete']);
    Route::get('edit-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'edit']);
    Route::post('update-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'update']);
    //////////////////////////////Skill////////////////////////////////////////////////////
    Route::get('skill', [App\Http\Controllers\Admin\SkillController::class, 'index']);
    Route::get('fetch-skill', [App\Http\Controllers\Admin\SkillController::class, 'fetch']);
    Route::post('add-skill', [App\Http\Controllers\Admin\SkillController::class, 'store']);
    Route::get('edit-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'edit']);
    Route::put('update-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'update']);
    Route::delete('delete-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'delete']);
});
