<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class testController extends Controller
{
    public static function getUserInformation($id) {
        $userInfo = User::query()->where('id', $id)->get('*');
        $testArray = [
            'username' => $userInfo->value('username'),
            'email' => $userInfo->value('email'),
        ];
        return view('test3')->with('userInfo', $testArray);
    }
}
