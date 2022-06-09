<?php

namespace App\Http\Controllers;

use App\Models\Navbar;

class navbarController extends Controller
{
    public function create() {

        $attributes = request()->validate([
            'title' => ['required', 'max: 255'],
            'location' => ['max: 255'],
            'permission' => ['required', 'max: 255'],
        ]);
        navbar::create($attributes);
        return back();
    }
}
