<?php

use Illuminate\Database\Seeder;

class SystemUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_users')->insert([
            [
                'group_id' => 1, // root
                'user_id' => 1,
                'user_name' => 'maika-kanaka',
                'user_fullname' => 'Maika Kanaka',
                'user_email' => 'bif@maika-kanaka.com',
                'user_password' => password_hash('123456', PASSWORD_DEFAULT),
                'is_new' => 'N',

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ],

            [
                'group_id' => 2,
                'user_id' => 2,
                'user_fullname' => 'Tn. Technician',
                'user_name' => 'technician',
                'user_email' => 'technician@maika-kanaka.com',
                'user_password' => password_hash('123456', PASSWORD_DEFAULT),
                'is_new' => 'N',

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ]
        ]);
    }
}
