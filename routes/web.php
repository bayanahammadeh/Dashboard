<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', function () {
    return view('client.index');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', [App\Http\Controllers\Admin\UserController::class, 'logout']);
});


Route::group(['prefix' => 'supper', 'middleware' => ['isSupper', 'auth']], function () {
    //////////////////////////Role////////////////////////////////
    Route::get('role', [App\Http\Controllers\Admin\RoleController::class, 'index']);
    Route::get('fetch-role', [App\Http\Controllers\Admin\RoleController::class, 'fetch']);
    Route::post('add-role', [App\Http\Controllers\Admin\RoleController::class, 'store']);
    Route::delete('delete-role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'delete']);
    Route::get('edit-role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit']);
    Route::post('update-role/{id}', [App\Http\Controllers\Admin\RoleController::class, 'update']);
    //////////////////////////User////////////////////////////////
    Route::get('user', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('fetch-user', [App\Http\Controllers\Admin\UserController::class, 'fetch']);
    Route::post('store-user', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('edit-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::post('update-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::delete('delete-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete']);
    Route::get('profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'profile']);
    Route::post('update-profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'update_profile']);
    //////////////////////////Personal////////////////////////////////
    Route::get('personal', [App\Http\Controllers\Admin\PersonalController::class, 'index']);
    Route::get('fetch-personal', [App\Http\Controllers\Admin\PersonalController::class, 'fetch']);
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
    //////////////////////////////Education-Detail////////////////////////////////////////////////////
    Route::get('ed', [\App\Http\Controllers\Admin\EdController::class, 'index']);
    Route::get('fetch-ed', [App\Http\Controllers\Admin\EdController::class, 'fetch']);
    Route::post('add-ed', [App\Http\Controllers\Admin\EdController::class, 'store']);
    Route::get('edit-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'edit']);
    Route::post('update-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'update']);
    Route::delete('delete-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'delete']);
    //////////////////////////////Experience-Detail////////////////////////////////////////////////////
    Route::get('ex', [\App\Http\Controllers\Admin\ExController::class, 'index']);
    Route::get('fetch-ex', [App\Http\Controllers\Admin\ExController::class, 'fetch']);
    Route::post('add-ex', [App\Http\Controllers\Admin\ExController::class, 'store']);
    Route::get('edit-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'edit']);
    Route::post('update-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'update']);
    Route::delete('delete-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'delete']);
    //////////////////////////////Contact////////////////////////////////////////////////////
    Route::get('contact', [\App\Http\Controllers\Admin\ContactController::class, 'index']);
    Route::get('fetch-contact', [App\Http\Controllers\Admin\ContactController::class, 'fetch']);
    Route::post('update-contact/{id}', [App\Http\Controllers\Admin\ContactController::class, 'update']);
});

Route::group(['prefix' => 'admin', 'middleware' =>  ['isAdmin', 'auth']], function () {
    //////////////////////////User////////////////////////////////
    Route::get('user', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('fetch-user', [App\Http\Controllers\Admin\UserController::class, 'fetch']);
    Route::post('store-user', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('edit-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::post('update-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update']);
    Route::get('profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'profile']);
    Route::post('update-profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'update_profile']);
    //////////////////////////Personal////////////////////////////////
    Route::get('personal', [App\Http\Controllers\Admin\PersonalController::class, 'index']);
    Route::get('fetch-personal', [App\Http\Controllers\Admin\PersonalController::class, 'fetch']);
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
    //////////////////////////////Education-Detail////////////////////////////////////////////////////
    Route::get('ed', [\App\Http\Controllers\Admin\EdController::class, 'index']);
    Route::get('fetch-ed', [App\Http\Controllers\Admin\EdController::class, 'fetch']);
    Route::post('add-ed', [App\Http\Controllers\Admin\EdController::class, 'store']);
    Route::get('edit-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'edit']);
    Route::post('update-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'update']);
    Route::delete('delete-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'delete']);
    //////////////////////////////Experience-Detail////////////////////////////////////////////////////
    Route::get('ex', [\App\Http\Controllers\Admin\ExController::class, 'index']);
    Route::get('fetch-ex', [App\Http\Controllers\Admin\ExController::class, 'fetch']);
    Route::post('add-ex', [App\Http\Controllers\Admin\ExController::class, 'store']);
    Route::get('edit-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'edit']);
    Route::post('update-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'update']);
    Route::delete('delete-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'delete']);
    //////////////////////////////Contact////////////////////////////////////////////////////
    Route::get('contact', [\App\Http\Controllers\Admin\ContactController::class, 'index']);
    Route::get('fetch-contact', [App\Http\Controllers\Admin\ContactController::class, 'fetch']);
    Route::post('update-contact/{id}', [App\Http\Controllers\Admin\ContactController::class, 'update']);
});


Route::group(['prefix' => 'user', 'middleware' =>  ['isUser', 'auth']], function () {
    //////////////////////////Profile/////////////////////////////////
    Route::get('profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'profile']);
    Route::post('update-profile/{id}', [App\Http\Controllers\Admin\UserController::class, 'update_profile']);
    //////////////////////////Personal////////////////////////////////
    Route::get('personal', [App\Http\Controllers\Admin\PersonalController::class, 'index']);
    Route::get('fetch-personal', [App\Http\Controllers\Admin\PersonalController::class, 'fetch']);
    Route::post('store-personal', [App\Http\Controllers\Admin\PersonalController::class, 'store']);
    Route::get('edit-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'edit']);
    Route::post('update-personal/{id}', [App\Http\Controllers\Admin\PersonalController::class, 'update']);
    //////////////////////////////Skill////////////////////////////////////////////////////
    Route::get('skill', [App\Http\Controllers\Admin\SkillController::class, 'index']);
    Route::get('fetch-skill', [App\Http\Controllers\Admin\SkillController::class, 'fetch']);
    Route::post('add-skill', [App\Http\Controllers\Admin\SkillController::class, 'store']);
    Route::get('edit-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'edit']);
    Route::post('update-skill/{id}', [App\Http\Controllers\Admin\SkillController::class, 'update']);
    //////////////////////////////Project////////////////////////////////////////////////////
    Route::get('project', [\App\Http\Controllers\Admin\ProjectController::class, 'index']);
    Route::get('fetch-project', [App\Http\Controllers\Admin\ProjectController::class, 'fetch']);
    Route::post('add-project', [App\Http\Controllers\Admin\ProjectController::class, 'store']);
    Route::get('edit-project/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'edit']);
    Route::post('update-project/{id}', [App\Http\Controllers\Admin\ProjectController::class, 'update']);
    //////////////////////////////Education////////////////////////////////////////////////////
    Route::get('education', [\App\Http\Controllers\Admin\EducationController::class, 'index']);
    Route::get('fetch-education', [App\Http\Controllers\Admin\EducationController::class, 'fetch']);
    Route::post('add-education', [App\Http\Controllers\Admin\EducationController::class, 'store']);
    Route::get('edit-education/{id}', [App\Http\Controllers\Admin\EducationController::class, 'edit']);
    Route::post('update-education/{id}', [App\Http\Controllers\Admin\EducationController::class, 'update']);
    //////////////////////////////Experience////////////////////////////////////////////////////
    Route::get('experience', [\App\Http\Controllers\Admin\ExperienceController::class, 'index']);
    Route::get('fetch-experience', [App\Http\Controllers\Admin\ExperienceController::class, 'fetch']);
    Route::post('add-experience', [App\Http\Controllers\Admin\ExperienceController::class, 'store']);
    Route::get('edit-experience/{id}', [App\Http\Controllers\Admin\ExperienceController::class, 'edit']);
    Route::post('update-experience/{id}', [App\Http\Controllers\Admin\ExperienceController::class, 'update']);
    //////////////////////////////Langs////////////////////////////////////////////////////
    Route::get('lang', [\App\Http\Controllers\Admin\LangController::class, 'index']);
    Route::get('fetch-lang', [App\Http\Controllers\Admin\LangController::class, 'fetch']);
    Route::post('add-lang', [App\Http\Controllers\Admin\LangController::class, 'store']);
    Route::get('edit-lang/{id}', [App\Http\Controllers\Admin\LangController::class, 'edit']);
    Route::post('update-lang/{id}', [App\Http\Controllers\Admin\LangController::class, 'update']);
    //////////////////////////////Social////////////////////////////////////////////////////
    Route::get('social', [\App\Http\Controllers\Admin\SocialController::class, 'index']);
    Route::get('fetch-social', [App\Http\Controllers\Admin\SocialController::class, 'fetch']);
    Route::post('add-social', [App\Http\Controllers\Admin\SocialController::class, 'store']);
    Route::get('edit-social/{id}', [App\Http\Controllers\Admin\SocialController::class, 'edit']);
    Route::post('update-social/{id}', [App\Http\Controllers\Admin\SocialController::class, 'update']);
    //////////////////////////////Education-Detail////////////////////////////////////////////////////
    Route::get('ed', [\App\Http\Controllers\Admin\EdController::class, 'index']);
    Route::get('fetch-ed', [App\Http\Controllers\Admin\EdController::class, 'fetch']);
    Route::post('add-ed', [App\Http\Controllers\Admin\EdController::class, 'store']);
    Route::get('edit-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'edit']);
    Route::post('update-ed/{id}', [App\Http\Controllers\Admin\EdController::class, 'update']);
    //////////////////////////////Experience-Detail////////////////////////////////////////////////////
    Route::get('ex', [\App\Http\Controllers\Admin\ExController::class, 'index']);
    Route::get('fetch-ex', [App\Http\Controllers\Admin\ExController::class, 'fetch']);
    Route::post('add-ex', [App\Http\Controllers\Admin\ExController::class, 'store']);
    Route::get('edit-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'edit']);
    Route::post('update-ex/{id}', [App\Http\Controllers\Admin\ExController::class, 'update']);
});
