<?php

namespace App\Http\Controllers;

use App\Models\User;

class RegisterController extends Controller
{
    function create()
    {
        return view('register');
    }

    function store() 
    {
        $attributes = request()->validate([
            'email' => 'required|max:255|unique:users,email',
            'username' => 'required|min:3|max:255|unique:users,username',
            'picture' => 'image',
            'password' => 'required|min:8|max:255|confirmed'
        ]);

        if (request()->picture) $attributes['picture'] = request()->file('picture')->store('pictures', 'public');
        $attributes['timezone'] = request()->timezone;
        
        $user = User::create($attributes);

        auth()->login($user);
        
        return redirect('/')->with('success', 'Your account has been created!');
    }

}