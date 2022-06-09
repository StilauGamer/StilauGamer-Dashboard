<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class themes extends Model
{
    use HasFactory;

    // Creating a new theme
    public static function create()
    {

    }
    // Get a theme through name, and make it return everything in an array.
    public static function get($themeId)
    {
        $themeColorsDB = themes::query()->where('id', $themeId)->get('*');
        return [
            'background-color' => $themeColorsDB->value('backgroundColor'),
            'main-color' => $themeColorsDB->value('mainColor'),
            'box-color' => $themeColorsDB->value('boxColor'),
            'line-color' => $themeColorsDB->value('lineColor'),
            'text-color' => $themeColorsDB->value('textColor'),
        ];
    }
}
