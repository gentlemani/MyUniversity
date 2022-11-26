<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
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
            $file = Archivo::Where("ubicacion", $path)->first();
            return Storage::download($path, $file->nombre_original, [$file->mime]);
        }
        return back();
    }
}
