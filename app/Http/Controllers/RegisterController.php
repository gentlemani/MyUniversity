<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Coordinator;
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
        $coordinator = Coordinator::create($request->all());
        $coordinator->user()->create($request->all());
        return redirect('/login')->with('succes', 'Account created successfully');
    }
}
