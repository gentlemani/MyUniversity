<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/home', [HomeController::class, 'index']);
Route::post('/home/studentRegistration', [HomeController::class, 'studentRegistration']);
Route::post('/home/teacherRegistration', [HomeController::class, 'teacherRegistration']);
Route::post('/home/subjectRegistration', [HomeController::class, 'subjectRegistration']);
Route::post('/home/studentSearch', [HomeController::class, 'studentSearch']);
Route::post('/home/teacherSearch', [HomeController::class, 'teacherSearch']);
Route::post('/home/subjectSearch', [HomeController::class, 'subjectSearch']);
Route::get('/home/eliminarTeacher/{id}', [HomeController::class, 'eliminateTeacher']);
Route::get('/home/eliminarStudent/{id}', [HomeController::class, 'eliminateStudent']);
Route::get('/home/eliminarSubject/{id}', [HomeController::class, 'eliminateSubject']);

Route::get('/logout', [LogoutController::class, 'logout']);
