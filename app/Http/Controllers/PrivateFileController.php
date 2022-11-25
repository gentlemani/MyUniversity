<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrivateFileController extends Controller
{

    public function StudentFiles($file)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }
        $path = "tareas/{$file}";
        if (Storage::exists($path)) {
            return Storage::download($path);
        }
        return back();
    }
}
