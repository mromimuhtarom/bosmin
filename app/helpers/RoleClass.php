<?php
namespace App\helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RoleClass {
    public static function RoleType2($menu)
    {
      $menus1 = DB::table('menu')
                ->join('role_access','menu.id', '=', 'role_access.menu_id')
                ->where('role_id', Session::get('roleId'))
                ->where('name', '=', $menu)
                ->where('type', '=', '2')
                ->first();
      return $menus1;
    }

    public static function RoleType1($menu)
    {
      $menus1 = DB::table('menu')
                ->join('role_access','menu.id', '=', 'role_access.menu_id')
                ->where('role_id', Session::get('roleId'))
                ->where('name', '=', $menu)
                ->where('type', '=', '1')
                ->first();
      return $menus1;
    }

    public static function RoleType0($menu)
    {
      $type0 = DB::table('menu')
                      ->join('role_access','menu.id', '=', 'role_access.menu_id')
                      ->where('role_id', Session::get('roleId'))
                      ->where('name', '=', $menu)
                      ->where('type', '=', '0')
                      ->first();
      return $type0;

    }
}

?>