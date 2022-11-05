<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
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

    public function subjectEnroll()
    {
    }
}
