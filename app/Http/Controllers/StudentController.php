<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFileRequest;
use App\Models\Archivo;
use App\Models\Schoolarship;
use App\Models\Student;
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
        $becas = Schoolarship::all();
        $student = User::find(Auth::id())->userable;
        return view('home.indexStudent', compact('subjects', 'subjectEnrolled', 'becas', 'student'));
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
        $tasks = $student->subjects->find($request->subject_id)->tasks;
        foreach ($tasks as $task) {
            $task->students()->syncWithoutDetaching($student->id);
        }
        return redirect(self::HOME);
    }
    public function becaEnroll(Request $request)
    {
        $student = User::find(Auth::id())->userable;
        $student->schoolarship_id = $request->schoolarship_id;
        $student->save();
        return redirect(self::HOME);
    }
    public function fileStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'archivo' => 'required',
        ]);
        if ($validator->fails()) {
            $tasks = User::find(Auth::id())->userable->tasks;
            $validator->errors()->add(
                'file',
                'Something is wrong with this field!'
            );
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
        $tasks = User::find(Auth::id())->userable->tasks;
        $subject_id = $request->subject_id;
        return redirect(self::HOME)->with(compact('tasks', 'subject_id'));
    }

    public function taskSearch(Request $request)
    {
        $user = User::find(Auth::id())->userable;
        $taskSearch = $user->tasks()->where('name', 'like', '%' . $request->name . '%')->get();
        return redirect(self::HOME)->with(compact('taskSearch'));
    }
    /*
    -------------------------------------------------------------------------------------------------
    Eliminar
    -------------------------------------------------------------------------------------------------
    */
    public function subjectDelete($id)
    {
        $student = User::find(Auth::id())->userable;

        $tasks = $student->subjects->find($id)->tasks;
        foreach ($tasks as $task) {
            $task->students()->detach($student->id);
        }
        $student->subjects()->detach($id);
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
    public function shoolarshipDelete()
    {
        $student = User::find(Auth::id())->userable;
        $student->schoolarship_id = null;
        $student->save();
        return redirect(self::HOME);
    }
}
