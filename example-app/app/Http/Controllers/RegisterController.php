<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store()
    {
        // Create the user
        $attributes = request()->validate([
            'name' => ['required', 'max: 255'],
            'username' => ['required', 'min: 3', 'max: 255'],
            'email' => ['required', 'email', 'max: 255'],
            'password' => ['required', 'min: 5', 'max: 255']
        ]);

        $user = User::create($attributes);
        Mail::raw("A user was just created on the dashboard.", function($message) use ($attributes) {
            $message->to($attributes['email'])
                ->subject('User Created!');
        });

        // Log in the user.
        Auth()->login($user);
        $test = [
            'id' => Auth::user()->id,
        ];
        userSettings::create($test);


        return redirect('/');
    }
}
