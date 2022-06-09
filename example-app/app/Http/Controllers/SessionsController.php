<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
        return view('login');
    }
    public function store()
    {
        $attributes = request()->validate([
            'username' => ['required', 'exists:users,username', 'min: 3', 'max: 255'],
            'password' => ['required', 'min: 5', 'max: 255']
        ]);

        if (auth()->attempt($attributes, true)) {
            return redirect('/dashboard/home');
        }
        return back();
    }
    public function destroy()
    {
        auth()->logout();
        return redirect('/');
    }
}
