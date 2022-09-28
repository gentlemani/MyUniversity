<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        User::create($request->validated());
        $correo = $request->email;

        //se revisa el dominio que se tiene y en base a eso se realizan las inserciones correospondientes.
        if (preg_match('/(\W|^)[\w.\-]{0,25}@(alumnos)\.udg\.mx(\W|$)/i', $correo)) {
            //codigo para insertar en la tabla alumno
        } else if (preg_match('/(\W|^)[\w.\-]{0,25}@(coordinadores)\.udg\.mx(\W|$)/i', $correo)) {
            DB::table('coordinators')->insertGetId([
                'name' => $request->name,
                'degree' => $request->degree,
                'gender' => $request->gender,
            ]);
        } else if (preg_match('/(\W|^)[\w.\-]{0,25}@(docentes)\.udg\.mx(\W|$)/i', $correo)) {
            //codigo para insertar en la tabla docentes
        }
        return redirect('/login')->with('succes', 'Account created successfully');
    }
}
