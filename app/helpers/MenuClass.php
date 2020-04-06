<?php
namespace App\helpers;
use Illuminate\Support\Facades\DB;

class MenuClass {

    public static function menuName($menuName) {
        $menus1 = Role::RoleType2($menuName);
        return $menus1;
    }

    public static function DBMenuStatus($dbmenuname)
    {
        $menu = DB::table('menu')
                ->where('name', '=', $dbmenuname)
                ->first();
        return $menu;
    }

}
?>