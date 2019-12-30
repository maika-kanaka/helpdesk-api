<?php namespace App\Models\Master;

use DB;

class Support
{

  public static $table = 'master_supports';

  public static function table()
  {
    return DB::table(self::$table);
  }

}
