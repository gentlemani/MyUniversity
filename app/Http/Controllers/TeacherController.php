<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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

    public function subjectEnroll(Request $request)
    {
        Subject::find($request->subject_id);
        $teacher = User::find(Auth::id())->userable;
        $teacher->subjects()->syncWithoutDetaching($request->subject_id);
        return redirect(self::HOME);
    }
    public function subjectShow()
    {
        $teacher = User::find(Auth::id())->userable;
        return redirect(self::HOME)->with(compact('teacher'));
    }
    public function subjectDelete($id)
    {
        $teacher = User::find(Auth::id())->userable;
        $teacher->subjects()->detach($id);
        return redirect(self::HOME);
    }
}
