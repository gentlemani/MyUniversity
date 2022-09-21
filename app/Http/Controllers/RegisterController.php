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
        $idCoordinador = DB::table('users')->where('email', $request->email)->value('id');
        $correo = $request->email;

        //se revisa el dominio que se tiene y en base a eso se realizan las inserciones correospondientes.
        if (preg_match('/(\W|^)[\w.\-]{0,25}@(alumnos)\.udg\.mx(\W|$)/i', $correo)) {
            //codigo para insertar en la tabla alumno
        } else if (preg_match('/(\W|^)[\w.\-]{0,25}@(coordinadores)\.udg\.mx(\W|$)/i', $correo)) {
            DB::table('coordinadores')->insert([
                'nombre' => $request->nombre,
                'carrera' => $request->carrera,
                'genero' => $request->genero,
                'codigo_c' => $request->codigo,
                'id_2' => $idCoordinador,
            ]);
        } else if (preg_match('/(\W|^)[\w.\-]{0,25}@(docentes)\.udg\.mx(\W|$)/i', $correo)) {
            //codigo para insertar en la tabla docentes
        }
        return redirect('/login')->with('succes', 'Account created successfully');
    }
}
