<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (preg_match("/(\W|^)[\w.\-]{0,25}@(coordinadores)\.udg\.mx(\W|$)/i", Auth::user()->email) === 1) {
            return redirect('/coordinador');
        } elseif (preg_match("/(\W|^)[\w.\-]{0,25}@(docentes)\.udg\.mx(\W|$)/i", Auth::user()->email) === 1) {
            return redirect('/docente');
        } elseif (preg_match("/(\W|^)[\w.\-]{0,25}@(alumnos)\.udg\.mx(\W|$)/i", Auth::user()->email) === 1) {
            return redirect('/alumno');
        }
    }
}
