<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PrivateFileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

/*
------------------------------------------------------------------------------------------------------
Rutas para login, registro y loguot
------------------------------------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout']);

/*
------------------------------------------------------------------------------------------------------
Ruta para determinar si el correo que se tiene es de coordinadores, docentes o alumnos y redirigir
------------------------------------------------------------------------------------------------------
*/

Route::get('/home', [emailController::class, 'index']);

/*
------------------------------------------------------------------------------------------------------
Rutas para el coordinador
------------------------------------------------------------------------------------------------------
*/

Route::get('/coordinador', [HomeController::class, 'index']);
Route::post('/home/studentRegistration', [HomeController::class, 'studentRegistration']);
Route::post('/home/teacherRegistration', [HomeController::class, 'teacherRegistration']);
Route::post('/home/subjectRegistration', [HomeController::class, 'subjectRegistration']);
Route::post('/home/becaRegistration', [HomeController::class, 'becaRegistration']);
Route::post('/home/studentSearch', [HomeController::class, 'studentSearch']);
Route::post('/home/teacherSearch', [HomeController::class, 'teacherSearch']);
Route::post('/home/subjectSearch', [HomeController::class, 'subjectSearch']);
Route::post('/home/becaSearch', [HomeController::class, 'becaSearch']);
Route::get('/home/eliminarTeacher/{id}', [HomeController::class, 'eliminateTeacher']);
Route::get('/home/eliminarStudent/{id}', [HomeController::class, 'eliminateStudent']);
Route::get('/home/eliminarSubject/{id}', [HomeController::class, 'eliminateSubject']);
Route::get('/home/eliminarBeca/{id}', [HomeController::class, 'eliminateBeca']);

/*
------------------------------------------------------------------------------------------------------
Rutas para el docente
------------------------------------------------------------------------------------------------------
*/

Route::get('/docente', [TeacherController::class, 'index']);
Route::post('/docente/subjectRegistration', [TeacherController::class, 'subjectAdd']);
Route::post('/docente/taskRegistration', [TeacherController::class, 'taskAdd']);
Route::post('/docente/attendanceRegistration', [TeacherController::class, 'attendanceAdd']);
Route::post('/docente/subjectShow', [TeacherController::class, 'subjectShow']);
Route::post('/docente/taskShow', [TeacherController::class, 'taskShow']);
Route::post('/docente/studentShow', [TeacherController::class, 'studentShow']);
Route::post('/docente/attendanceShow', [TeacherController::class, 'attendanceShow']);
Route::get('/docente/subjectDelete/{id}', [TeacherController::class, 'subjectDelete']);
Route::get('/docente/taskDelete/{id}', [TeacherController::class, 'taskDelete']);


/*
------------------------------------------------------------------------------------------------------
//Rutas para el alumno
------------------------------------------------------------------------------------------------------
*/

Route::get('/alumno', [StudentController::class, 'index']);
Route::post('/alumno/subjectRegistration', [StudentController::class, 'subjectEnroll']);
Route::post('/alumno/becaRegistration', [StudentController::class, 'becaEnroll']);
Route::post('/alumno/fileAdd', [StudentController::class, 'fileStore']);
Route::get('/alumno/fileDelete/{id}', [StudentController::class, 'fileDelete']);
Route::post('/alumno/subjectShow', [StudentController::class, 'subjectShow']);
Route::post('/alumno/taskShow', [StudentController::class, 'taskShow']);
Route::post('/alumno/taskSearch', [StudentController::class, 'taskSearch']);
Route::get('/alumno/subjectDelete/{id}', [StudentController::class, 'subjectDelete']);
Route::get('/alumno/shoolarshipDelete/', [StudentController::class, 'shoolarshipDelete']);

/*
------------------------------------------------------------------------------------------------------
//Rutas para archivos
------------------------------------------------------------------------------------------------------
*/
route::get('/tareas/{file}', [PrivateFileController::class, 'StudentFiles']);
Route::get('/archivo', function () {
    return view('home.archivo');
});
