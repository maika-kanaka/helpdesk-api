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
            'group_id' => 1, // root
            'user_fullname' => 'Maika Kanaka',
            'user_email' => 'bif@maika-kanaka.com',
            'user_password' => password_hash('123456', PASSWORD_DEFAULT),

            'created_at' => '2000-01-01 00:00:00',
            'created_by' => 0
        ]);
    }
}
