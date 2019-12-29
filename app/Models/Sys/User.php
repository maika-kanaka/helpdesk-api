<?php namespace App\Models\Sys;

use DB;

class User
{

  public static $table = 'system_users';

  public static function table()
  {
    return DB::table(self::$table);
  }

}
