<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // if (!Auth::check()) {
        //     return redirect('/login');
        // }
        // if (preg_match("/(\W|^)[\w.\-]{0,25}@(alumnos)\.udg\.mx(\W|$)/i", Auth::user()->email) === 0) {
        //     return redirect('/home');
        // }


        return view('home.indexStudent');
    }
}
