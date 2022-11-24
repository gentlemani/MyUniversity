<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    const HOME = '/alumno';
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (preg_match("/(\W|^)[\w.\-]{0,25}@(alumnos)\.udg\.mx(\W|$)/i", Auth::user()->email) === 0) {
            return redirect('/home');
        }
        $subjects = Subject::all();
        $subjectEnrolled = User::find(Auth::id())->userable->subjects;
        return view('home.indexStudent', compact('subjects', 'subjectEnrolled'));
    }
    /*
    -------------------------------------------------------------------------------------------------
    Agregar
    -------------------------------------------------------------------------------------------------
    */
    public function subjectEnroll(Request $request)
    {
        $student = User::find(Auth::id())->userable;
        $student->subjects()->syncWithoutDetaching($request->subject_id);
        return redirect(self::HOME);
    }
    /*
    -------------------------------------------------------------------------------------------------
    Mostrar
    -------------------------------------------------------------------------------------------------
    */
    public function subjectShow()
    {
        $subjects = User::find(Auth::id())->userable->subjects;
        return redirect(self::HOME)->with(compact('subjects'));
    }

    public function taskShow(Request $request)
    {
        $tasks = Subject::find($request->subject_id)->tasks;
        return redirect(self::HOME)->with(compact('tasks'));
    }
    /*
    -------------------------------------------------------------------------------------------------
    Eliminar
    -------------------------------------------------------------------------------------------------
    */
    public function subjectDelete($id)
    {
        $teacher = User::find(Auth::id())->userable;
        $teacher->subjects()->detach($id);
        return redirect(self::HOME);
    }
}
