<?php namespace App\Models\Master;

use DB;

class Category
{

  public static $table = 'master_categories';

  public static function table()
  {
    return DB::table(self::$table);
  }

}
