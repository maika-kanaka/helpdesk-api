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

        $inserts = [];
        foreach($menus as $k => $v){
            $inserts[] = [
                'group_id' => 1, // root
                'menu_id' => $v->menu_id,
                'can_access' => 'Y'
            ];
        }

        DB::table('system_user_group_access')->insert($inserts);
    }
}
