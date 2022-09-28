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
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('home.index');
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
}
