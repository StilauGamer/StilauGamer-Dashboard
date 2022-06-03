<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function create()
    {
        $attributes = request()->validate([
            'permission' => ['required', 'max: 255']
        ]);

        Permission::create(['name' => $attributes['permission']]);
        return back();
    }
    public function remove()
    {
        $attributes = request()->validate([
            'permission' => ['required', 'max: 255']
        ]);

        Permission::query()->where('name', $attributes['permission'])->delete();
        return back();
    }
    public function add()
    {
        $attributes = request()->validate([
            'permission' => ['required', 'max: 255'],
            'username' => ['required', 'max: 255']
        ]);
        $user = User::query()->where('username', $attributes['username'])->first();
        $user->givePermissionTo($attributes['permission']);
        return back();
    }
    public function delete()
    {
        $attributes = request()->validate([
            'permission' => ['required', 'max: 255'],
            'username' => ['required', 'max: 255']
        ]);
        $user = User::query()->where('username', $attributes['username'])->first();
        $user->revokePermissionTo($attributes['permission']);
        return back();
    }
}
