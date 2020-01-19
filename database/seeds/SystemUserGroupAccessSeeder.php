<?php

use Illuminate\Database\Seeder;

class SystemUserGroupAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = DB::table('system_menus')->get();

        # insert root: ALL
        $insert_root = [];
        foreach($menus as $k => $v){
            $insert_root[] = [
                'group_id' => 1, // root
                'menu_id' => $v->menu_id,
                'can_access' => 'Y'
            ];
        }

        $insert_technician = [];
        $insert_technician[] = ['group_id' => 2, 'menu_id' => 'master', 'can_access' => 'Y'];
        $insert_technician[] = ['group_id' => 2, 'menu_id' => 'master_categories', 'can_access' => 'Y'];
        $insert_technician[] = ['group_id' => 2, 'menu_id' => 'tickets', 'can_access' => 'Y'];
        $insert_technician[] = ['group_id' => 2, 'menu_id' => 'ticket_view_support', 'can_access' => 'Y'];
        $insert_technician[] = ['group_id' => 2, 'menu_id' => 'system', 'can_access' => 'Y'];
        $insert_technician[] = ['group_id' => 2, 'menu_id' => 'system_users', 'can_access' => 'Y'];

        $insert_requester = [];
        $insert_requester[] = ['group_id' => 3, 'menu_id' => 'tickets', 'can_access' => 'Y'];
        $insert_requester[] = ['group_id' => 3, 'menu_id' => 'ticket_cud', 'can_access' => 'Y'];

        $inserts = array_merge($insert_root, $insert_technician, $insert_requester);
        DB::table('system_user_group_access')->insert($inserts);
    }
}
