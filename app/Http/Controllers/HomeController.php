<?php

namespace App\Http\Controllers;

use App\Http\Requests\BecaRegistrationRequest;
use App\Http\Requests\StudentRegistrationRequest;
use App\Http\Requests\SubjectRegistrationRequest;
use App\Http\Requests\TeacherRegistrationRequest;
use App\Models\Schoolarship;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
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
        $searchBeca = $request->session()->get('searchBeca');

        return view('home.indexCoordinator', compact('searchStudent', 'searchTeacher', 'searchSubject', 'searchBeca'));
    }
    // ...........................................................................................
    // Insersiones
    // ...........................................................................................
    public function studentRegistration(StudentRegistrationRequest $request)
    {
        $coordinatorId = User::find(Auth::id())->userable->id;
        $request->merge(['coordinator_id' => $coordinatorId]);
        $student = Student::create($request->all());
        $student->user()->create($request->all());
        return redirect(self::HOME);
    }
    public function teacherRegistration(TeacherRegistrationRequest $request)
    {
        $coordinatorId = User::find(Auth::id())->userable->id;
        $request->merge(['coordinator_id' => $coordinatorId]);
        $teacher = Teacher::create($request->all());
        $teacher->user()->create($request->all());
        return redirect(self::HOME);
    }
    public function subjectRegistration(SubjectRegistrationRequest $request)
    {
        $coordinatorId = User::find(Auth::id())->userable->id;
        $request->merge(['coordinator_id' => $coordinatorId]);
        Subject::create($request->all());
        return redirect(self::HOME);
    }
    public function becaRegistration(BecaRegistrationRequest $request)
    {
        Schoolarship::create($request->all());
        return redirect(self::HOME);
    }
    // ...........................................................................................
    // Busquedas
    // ...........................................................................................
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
    public function becaSearch(Request $request)
    {
        $searchBeca = Schoolarship::where('name', 'LIKE', '%' . $request->name . '%')->get();
        $searchBeca->consultaRealizada = true;
        return redirect(self::HOME)->with(compact('searchBeca'));
    }
    // ...........................................................................................
    // Eliminaciones
    // ...........................................................................................
    public function eliminateTeacher($id)
    {
        $teacher = Teacher::find($id);
        $teacher->user()->delete();
        $teacher->delete();
        return redirect(self::HOME);
    }

    public function eliminateStudent($id)
    {
        $student = Student::find($id);
        $student->user()->delete();
        $student->delete();
        return redirect(self::HOME);
    }
    public function eliminateSubject($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect(self::HOME);
    }
    public function eliminateBeca($id)
    {
        $beca = Schoolarship::find($id);
        foreach ($beca->students as $student) {
            $student->schoolarship_id = null;
            $student->save();
        }
        $beca->delete();
        return redirect(self::HOME);
    }
}
