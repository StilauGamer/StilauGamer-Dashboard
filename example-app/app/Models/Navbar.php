<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class navbar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'permission',
    ];

    public static function create(...$permission)
    {
        if ($permission[0]['permission'] == null) {
            navbar::query()->create(['title' => $permission[0]['title'], 'location' => $permission[0]['location'], 'permission' => null]);
        } else {
            $permissionId = Permission::query()->where('id', $permission[0]['permission'])->orWhere('name', $permission[0]['permission'])->first();
            navbar::query()->create(['title' => $permission[0]['title'], 'location' => $permission[0]['location'], 'permission' => $permissionId['id']]);
        }
        return $permission;
    }
    public static function get($userModel)
    {
        $navItems = '';
        foreach($userModel->getPermissionNames() as $permissionName) {
            $permissionIds = Permission::query()->where('name', $permissionName)->get('id');
            foreach ($permissionIds as $permissionId) {
                $navItemsDb = navbar::query()->where('permission', $permissionId->id)->orWhere('permission', null)->get('*');
                foreach ($navItemsDb as $navItem) {
                    $active = ($navItem->location == $_SERVER['REQUEST_URI']) ? "active" : null;
                    $navItems .= "<a href=$navItem->location class=$active>$navItem->title</a>";
                }
            }
        }
        return $navItems;
    }
    public static function getRequiredPermission($navItem)
    {
        // Checks for the item in the database
        // Return the permission column from the database
    }
}
