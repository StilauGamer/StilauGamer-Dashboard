<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class currentpageController extends Controller
{
    public static function getCurrentPage()
    {
        $currentPage = basename($_SERVER['PHP_SELF'], '.php');
        $currentPage = preg_replace('/(?<!\ )[A-Z]/', ' $0', $currentPage);
        return ucfirst($currentPage);
    }
}
