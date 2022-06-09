<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
    ];

    public static function getLayoutId($userModel)
    {
        $layoutDb = userSettings::query()->where('id', $userModel->id)->get('*');
        return $layoutDb->value('layout');
    }
    public static function getThemeId($userModel)
    {
        $themeDb = userSettings::query()->where('id', $userModel->id)->get('*');
        return $themeDb->value('theme');
    }
}
