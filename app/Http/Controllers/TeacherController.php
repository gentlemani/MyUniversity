<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherSubjectAddRequest;
use App\Http\Requests\TeacherTaskAddRequest;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    const HOME = '/docente';
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (preg_match("/(\W|^)[\w.\-]{0,25}@(docentes)\.udg\.mx(\W|$)/i", Auth::user()->email) === 0) {
            return redirect('/login');
        }
        $subjects = Subject::all();
        return view('home.indexTeacher', compact('subjects'));
    }
    /*
    -------------------------------------------------------------------------------------------------
    Agregar
    -------------------------------------------------------------------------------------------------
    */
    public function subjectAdd(TeacherSubjectAddRequest $request)
    {
        Subject::find($request->subject_id);
        $teacher = User::find(Auth::id())->userable;
        $teacher->subjects()->syncWithoutDetaching($request->subject_id);
        return redirect(self::HOME);
    }
    public function taskAdd(TeacherTaskAddRequest $request)
    {
        $teacherId = User::find(Auth::id())->userable->id;
        $request->merge(['teacher_id' => $teacherId]);
        Task::create($request->all());
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

    public function taskShow()
    {
        $tasks = User::find(Auth::id())->userable->tasks;
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
    public function taskDelete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect(self::HOME);
    }
}
