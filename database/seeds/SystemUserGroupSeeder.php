<?php

use Illuminate\Database\Seeder;

class SystemUserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_user_group')->insert([
            [
                'group_id' => 1,
                'group_name' => 'Root',
                'group_desc' => 'login as root/superadmin',

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ],

            [
                'group_id' => 2,
                'group_name' => 'Technician IT',
                'group_desc' => NULL,

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ]
        ]);
    }
}
