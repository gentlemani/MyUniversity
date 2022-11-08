<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherAttendanceRequest;
use App\Http\Requests\TeacherSubjectAddRequest;
use App\Http\Requests\TeacherTaskAddRequest;
use App\Models\Attendance;
use App\Models\Student;
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
        $teacher = User::find(Auth::id())->userable;
        return view('home.indexTeacher', compact('subjects', 'teacher'));
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
        $task = Task::create($request->all());
        $subject = Subject::find($request->subject_id);
        foreach ($subject->students as $key => $value) {
            $task->students()->syncWithoutDetaching([$value['id']]);
        }
        return redirect(self::HOME);
    }
    public function attendanceAdd(TeacherAttendanceRequest $request)
    {
        $teacherId = User::find(Auth::id())->userable->id;
        $status = json_decode($request->status[0]);
        $request->merge(['teacher_id' => $teacherId, 'subject_id' => $status->pivot->subject_id]);
        $attendance = Attendance::create($request->all());
        foreach ($request->status as $key => $value) {
            $array = json_decode($value);
            $idStudent = $array->id;
            $attendance->students()->syncWithoutDetaching([$idStudent => ['status' => 'Asistio']]);
        }

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
    public function studentShow(Request $request)
    {
        $students = Subject::find($request->subject_id)->students;
        return redirect(self::HOME)->with(compact('students'));
    }
    public function attendanceShow(Request $request)
    {
        $registredAttendances = Attendance::where('date', 'LIKE', '%' . $request->date . '%')->get();
        $subject = Subject::find($request->subject_id);
        $attendance = $subject->attendances;
        return redirect(self::HOME)->with(compact('registredAttendances', 'attendance'));
    }
    /*
    -------------------------------------------------------------------------------------------------
    Eliminar
    -------------------------------------------------------------------------------------------------
    */
    public function subjectDelete($id)
    {
        $subject = Subject::find($id);
        foreach ($subject->tasks as $key => $value) {
            self::taskDelete($value->id);
        }
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
    public function attendanceDelete($id)
    {
        $task = Attendance::find($id);
        $task->delete();
        return redirect(self::HOME);
    }
}
