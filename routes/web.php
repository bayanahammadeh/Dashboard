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
    Route::get('fetch-personal', [App\Http\Controllers\Admin\PersonalController::class,'fetch']);
    Route::post('store-personal', [App\Http\Controllers\Admin\PersonalController::class, 'store']);
    Route::delete('delete-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'delete']);
    Route::get('edit-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'edit']);
    Route::post('update-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'update']);
    //////////////////////////////Skill////////////////////////////////////////////////////
    Route::get('skill', [App\Http\Controllers\Admin\SkillController::class, 'index']);
    Route::get('fetch-skill', [App\Http\Controllers\Admin\SkillController::class, 'fetch']);
    Route::post('add-skill', [App\Http\Controllers\Admin\SkillController::class, 'store']);
    Route::get('edit-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'edit']);
    Route::post('update-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'update']);
    Route::delete('delete-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'delete']);
    //////////////////////////////Project////////////////////////////////////////////////////
    Route::get('project', [\App\Http\Controllers\Admin\ProjectController::class, 'index']);
    Route::get('fetch-project', [App\Http\Controllers\Admin\ProjectController::class, 'fetch']);
    Route::post('add-project', [App\Http\Controllers\Admin\ProjectController::class, 'store']);
    Route::get('edit-project/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'edit']);
    Route::post('update-project/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'update']);
    Route::delete('delete-project/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'delete']);
    //////////////////////////////Education////////////////////////////////////////////////////
    Route::get('education', [\App\Http\Controllers\Admin\EducationController::class, 'index']);
    Route::get('fetch-education', [App\Http\Controllers\Admin\EducationController::class, 'fetch']);
    Route::post('add-education', [App\Http\Controllers\Admin\EducationController::class, 'store']);
    Route::get('edit-education/{id}', [App\Http\Controllers\Admin\EducationController::class, 'edit']);
    Route::post('update-education/{id}', [App\Http\Controllers\Admin\EducationController::class, 'update']);
    Route::delete('delete-education/{id}', [App\Http\Controllers\Admin\EducationController::class, 'delete']);
    //////////////////////////////Experience////////////////////////////////////////////////////
    Route::get('experience', [\App\Http\Controllers\Admin\ExperienceController::class, 'index']);
    Route::get('fetch-experience', [App\Http\Controllers\Admin\ExperienceController::class, 'fetch']);
    Route::post('add-experience', [App\Http\Controllers\Admin\ExperienceController::class, 'store']);
    Route::get('edit-experience/{id}', [App\Http\Controllers\Admin\ExperienceController::class, 'edit']);
    Route::post('update-experience/{id}', [App\Http\Controllers\Admin\ExperienceController::class, 'update']);
    Route::delete('delete-experience/{id}', [App\Http\Controllers\Admin\ExperienceController::class, 'delete']);
    //////////////////////////////Langs////////////////////////////////////////////////////
    Route::get('lang', [\App\Http\Controllers\Admin\LangController::class, 'index']);
    Route::get('fetch-lang', [App\Http\Controllers\Admin\LangController::class, 'fetch']);
    Route::post('add-lang', [App\Http\Controllers\Admin\LangController::class, 'store']);
    Route::get('edit-lang/{id}', [App\Http\Controllers\Admin\LangController::class, 'edit']);
    Route::post('update-lang/{id}', [App\Http\Controllers\Admin\LangController::class, 'update']);
    Route::delete('delete-lang/{id}', [App\Http\Controllers\Admin\LangController::class, 'delete']);
    //////////////////////////////Social////////////////////////////////////////////////////
    Route::get('social', [\App\Http\Controllers\Admin\SocialController::class, 'index']);
    Route::get('fetch-social', [App\Http\Controllers\Admin\SocialController::class, 'fetch']);
    Route::post('add-social', [App\Http\Controllers\Admin\SocialController::class, 'store']);
    Route::get('edit-social/{id}', [App\Http\Controllers\Admin\SocialController::class, 'edit']);
    Route::post('update-social/{id}', [App\Http\Controllers\Admin\SocialController::class, 'update']);
    Route::delete('delete-social/{id}', [App\Http\Controllers\Admin\SocialController::class, 'delete']);
});
