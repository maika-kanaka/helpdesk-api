<?php namespace App\Models\Trx;

use DB;

class Ticket
{

    public static $table = 'trx_tickets';

    public static function table($as = '')
    {
      $table = self::$table;
      $table .= !empty($as) ? " AS $as" : "";
      return DB::table($table);
    }

    public static function primaryKey()
    {
        $query = self::table()->orderBy('ticket_id', 'desc')->first();

        if(empty($query)){
            return 1;
        }

        return $query->ticket_id + 1;
    }

    public static function generateCode()
    {
        # format
        $format = date("Ym");

        # get data
        $query = self::table()->orderBy('ticket_code', 'desc')->first();

        # jika belum ada kenangan apapun maka buatlah kenangan pertama yang paling indah
        if(empty($query)){
            return $format . "0001";
        }

        # jika periode sudah berlalu maka kita mulai dari awal lagi
        $yearmonth = substr($query->ticket_code, 0, 6);
        if($yearmonth != date('Ym')){
            return $format . "0001";
        }

        # buat increment
        $increment = (int) substr($query->ticket_code, 7, 4);
        if(strlen($increment) == 4)
        {
            if($increment == 9999){
                return false;
            }else{
                $increment++;
                return $format . $increment;
            }
        }
        else if(strlen($increment) == 3)
        {
            if($increment == 999){
                return $format . "1000";
            }else{
                $increment++;
                return $format . "0" . $increment;
            }
        }
        else if(strlen($increment) == 2)
        {
            if($increment == 99){
                return $format . "0100";
            }else{
                $increment++;
                return $format . "00" . $increment;
            }
        }
        else if(strlen($increment) == 1)
        {
            if($increment == 9){
                return $format . "0010";
            }else{
                $increment++;
                return $format . "000" . $increment;
            }
        }
    }

}
