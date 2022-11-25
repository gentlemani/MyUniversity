<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFileRequest;
use App\Models\Archivo;
use App\Models\Subject;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function fileStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);
        if ($validator->fails()) {

            $tasks = Subject::find($request->subject_id)->tasks->load('students');
            return redirect(self::HOME)->with(compact('tasks'))->withErrors($validator);
        }

        if ($request->file('archivo')->isValid()) {
            $ubicacion = $request->archivo->store('tareas');
            $archivo = new Archivo();
            $archivo->task_id = $request->task_id;
            $archivo->ubicacion = $ubicacion;
            $archivo->nombre_original = $request->archivo->getClientOriginalName();
            $archivo->mime = $request->archivo->getClientMimeType();
            $archivo->save();
            $student = User::find(Auth::id())->userable;
            $student->tasks()->updateExistingPivot($request->task_id, [
                'fileUploaded' => $archivo->ubicacion,
            ]);
            return redirect(self::HOME);
        }
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
        $tasks = Subject::find($request->subject_id)->tasks->load('students');
        $subject_id = $request->subject_id;
        return redirect(self::HOME)->with(compact('tasks', 'subject_id'));
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
    public function fileDelete($id)
    {
        $student = User::find(Auth::id())->userable;
        $student->tasks()->updateExistingPivot($id, [
            'fileUploaded' => null,
        ]);
        return redirect(self::HOME);
    }
}
