<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException as ValidationException;

class SessionsController extends Controller
{
    public function create() 
    {
        return view('login');
    }

    public function store() 
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes)) {
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome Back!');
        }

        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/login')->with('success', 'Goodbye!');
    }
}