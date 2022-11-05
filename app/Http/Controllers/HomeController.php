<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRegistrationRequest;
use App\Http\Requests\SubjectRegistrationRequest;
use App\Http\Requests\TeacherRegistrationRequest;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    const HOME = '/coordinador';
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (preg_match("/(\W|^)[\w.\-]{0,25}@(coordinadores)\.udg\.mx(\W|$)/i", Auth::user()->email) === 0) {
            return redirect('/login');
        }
        $searchStudent = $request->session()->get('searchStudent');
        $searchTeacher = $request->session()->get('searchTeacher');
        $searchSubject = $request->session()->get('searchSubject');

        return view('home.indexCoordinator', compact('searchStudent', 'searchTeacher', 'searchSubject'));
    }

    public function studentRegistration(StudentRegistrationRequest $request)
    {
        $request->merge(['coordinator_id' => Auth::id()]);
        Student::create($request->all());
        return redirect()->action([HomeController::class, 'index']);
    }
    public function teacherRegistration(TeacherRegistrationRequest $request)
    {
        $request->merge(['coordinator_id' => Auth::id()]);
        Teacher::create($request->all());
        return redirect()->action([HomeController::class, 'index']);
    }
    public function subjectRegistration(SubjectRegistrationRequest $request)
    {
        $request->merge(['coordinator_id' => Auth::id()]);
        Subject::create($request->all());
        return redirect()->action([HomeController::class, 'index']);
    }
    public function studentSearch(Request $request)
    {
        $searchStudent = Student::where('name', 'LIKE', '%' . $request->name . '%')->get();
        $searchStudent->consultaRealizada = true;
        return redirect(self::HOME)->with(compact('searchStudent'));
    }

    public function teacherSearch(Request $request)
    {
        $searchTeacher = Teacher::where('name', 'LIKE', '%' . $request->name . '%')->get();
        $searchTeacher->consultaRealizada = true;
        return redirect(self::HOME)->with(compact('searchTeacher'));
    }
    public function subjectSearch(Request $request)
    {
        $searchSubject = Subject::where('name', 'LIKE', '%' . $request->name . '%')->get();
        $searchSubject->consultaRealizada = true;
        return redirect(self::HOME)->with(compact('searchSubject'));
    }
    public function eliminateTeacher($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect(self::HOME);
    }

    public function eliminateStudent($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect(self::HOME);
    }
    public function eliminateSubject($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect(self::HOME);
    }

    public function enrollStudent($id)
    {
        return redirect(self::HOME);
    }
}
