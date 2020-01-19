<?php namespace App\Models\Sys;

class Group
{

  public static $table = 'system_user_group';
  public static $table_access = 'system_user_group_access';

  public static function table()
  {
    // alias data()
    return self::data();
  }

  public static function primaryKey()
  {
    $DB   = self::table()
                 ->orderBy("group_id", "desc")
                 ->first();

    if(empty($DB)){
      $id    = 1;
    }else{
      $id    = $DB->group_id + 1;
    }

    return $id;
  }

  public static function tableAccess()
  {
    return \DB::table(self::$table_access);
  }

}
