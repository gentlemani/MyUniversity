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
        $user = User::create($request->validated());

        $correo = $request->email;
        $pwd = $request->password;


        if (preg_match('/(\W|^)[\w.\-]{0,25}@(alumnos)\.udg\.mx(\W|$)/i', $correo)) {
            DB::table('users')->insert([
                'email' => $correo,
                'password' => $pwd,
                'tipo_cuenta' => 'a'
            ]);
        } else if (preg_match('/(\W|^)[\w.\-]{0,25}@(coordinadores)\.udg\.mx(\W|$)/i', $correo)) {
            DB::table('coordinador')->insert([
                'nombre' => $request->nombre,
                'carrera' => $request->carrera,
                'genero' => $request->genero,
                'codigo_c' => $request->codigo,
                'email_2' => $correo,
            ]);
        } else if (preg_match('/(\W|^)[\w.\-]{0,25}@(docentes)\.udg\.mx(\W|$)/i', $correo)) {
            DB::table('users')->insert([
                'email' => $correo,
                'password' => $pwd,
                'tipo_cuenta' => 'd'
            ]);
        }
        return redirect('/login')->with('succes', 'Account created successfully');
    }
}
