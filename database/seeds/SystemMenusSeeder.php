<?php

use Illuminate\Database\Seeder;

class SystemMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [];

        $menus[] = [
            'menu_id' => 'system',
            'menu_id_top' => NULL,
            'menu_name' => 'System',
            'menu_desc' => NULL,
            'menu_order' => 9999,
            'is_active' => 'Y',
            'created_at' => '2000-01-01 00:00:00',
            'created_by' => 0
        ];

        $menus[] = [
            'menu_id' => 'system_user_group',
            'menu_id_top' => 'system',
            'menu_name' => 'User Groups',
            'menu_desc' => NULL,
            'menu_order' => 1,
            'is_active' => 'Y',
            'created_at' => '2000-01-01 00:00:00',
            'created_by' => 0
        ];

        $menus[] = [
            'menu_id' => 'system_users',
            'menu_id_top' => 'system',
            'menu_name' => 'Users',
            'menu_desc' => NULL,
            'menu_order' => 2,
            'is_active' => 'Y',
            'created_at' => '2000-01-01 00:00:00',
            'created_by' => 0
        ];

        $menus[] = [
            'menu_id' => 'system_menus',
            'menu_id_top' => 'system',
            'menu_name' => 'Menus',
            'menu_desc' => NULL,
            'menu_order' => 3,
            'is_active' => 'Y',
            'created_at' => '2000-01-01 00:00:00',
            'created_by' => 0
        ];

        DB::table('system_menus')->insert($menus);
    }
}
