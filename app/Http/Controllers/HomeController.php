<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRegistrationRequest;
use App\Http\Requests\SubjectRegistrationRequest;
use App\Http\Requests\TeacherRegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    const HOME = '/home';
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $searchStudent = $request->session()->get('searchStudent');
        $searchTeacher = $request->session()->get('searchTeacher');
        $searchSubject = $request->session()->get('searchSubject');
        return view('home.index', compact('searchStudent', 'searchTeacher', 'searchSubject'));
    }

    public function studentRegistration(StudentRegistrationRequest $request)
    {
        $iduser = Auth::id();
        DB::table('students')->insertGetId([
            'name' => $request->name,
            'semester' => $request->semester,
            'degree' => $request->degree,
            'id_coordinator2' => $iduser,
        ]);
        return redirect()->action([HomeController::class, 'index']);
    }
    public function teacherRegistration(TeacherRegistrationRequest $request)
    {
        $iduser = Auth::id();
        DB::table('teachers')->insertGetId([
            'name' => $request->name,
            'gender' => $request->gender,
            'id_coordinator4' => $iduser,
        ]);
        return redirect()->action([HomeController::class, 'index']);
    }
    public function subjectRegistration(SubjectRegistrationRequest $request)
    {
        $iduser = Auth::id();
        DB::table('subjects')->insertGetId([
            'name' => $request->name,
            'gender' => $request->gender,
            'id_coordinator3' => $iduser,
        ]);
        return redirect()->action([HomeController::class, 'index']);
    }
    public function studentSearch(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $searchStudent = DB::table('students')->where('name', 'LIKE', '%' . $request->name . '%')->get();
        return redirect(self::HOME)->with(compact('searchStudent'));
    }

    public function teacherSearch(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $searchTeacher = DB::table('teachers')->where('name', 'LIKE', '%' . $request->name . '%')->get();
        return redirect(self::HOME)->with(compact('searchTeacher'));
    }
    public function subjectSearch(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $searchSubject = DB::table('subjects')->where('name', 'LIKE', '%' . $request->name . '%')->get();
        return redirect(self::HOME)->with(compact('searchSubject'));
    }
    public function eliminateTeacher($id)
    {
        DB::table('teachers')->where('id', $id)->delete();
        return redirect(self::HOME);
    }

    public function eliminateStudent($id)
    {
        DB::table('students')->where('id', $id)->delete();
        return redirect(self::HOME);
    }
    public function eliminateSubject($id)
    {
        DB::table('subjects')->where('id', $id)->delete();
        return redirect(self::HOME);
    }
}
