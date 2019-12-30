<?php namespace App\Models\Sys;

use DB;

class UserSupport
{

  public static $table = 'system_user_support';

  public static function table()
  {
    return DB::table(self::$table);
  }

}
