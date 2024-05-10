<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit() 
    {
        return view('profile');
    }

    public function update()
    {
        $attributes = request()->validate(['picture' => 'image']);

        if (isset($attributes['picture'])) {
            $attributes['picture'] = request()->file('picture')->store('pictures', 'public');
            auth()->user()->update(['picture' => $attributes['picture']]);
        }  
        
        if (request()['current_password']) {
            $validatedNewPass = request()->validate([
                'current_password' => 'min:8|max:255',
                'newPassword' => 'required|min:8|max:255|confirmed'
            ]);
            if (Hash::check($validatedNewPass['current_password'], auth()->user()->password)) {
                auth()->user()->update(['password' => bcrypt($validatedNewPass['newPassword'])]);
                return redirect('/profile')->with('success', 'Your profile has been updated!');
            }    
            request()->session()->flash('error', 'Password does not match');
            return redirect('/profile');  
        }

        return redirect('/profile')->with('success', 'Your profile has been updated!');    
    }

}