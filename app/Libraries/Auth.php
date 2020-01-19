<?php

  /*
  * Created Date         : Start Develop
  * Created By           : Budi Irwan Firmansyah
  * Description          : -. All about security access
  * ________________________________________________________________________
  * | No | Edited Date    | Edited By   | Reason Edit                      |
  * ------------------------------------------------------------------------
  * |    |                |             |                                  |
  * |    |                |             |                                  |
  *
  */

  namespace App\Libraries;

  use \Firebase\JWT\JWT;

  use App\Models\Sys\User;
  use App\Models\Sys\Group;

  class Auth
  {

    public static function role_api($group_id, $menu_id)
    {
        $group_access = Group::tableAccess()
                                ->where('group_id', $group_id)
                                ->where('menu_id', $menu_id)
                                ->first();

        if(empty($group_access)){
            return False;
        }

        if($group_access->can_access != 'Y'){
            return False;
        }

        return True;
    }

  }
