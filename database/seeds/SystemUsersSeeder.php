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
                'user_category' => NULL,
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
                'user_fullname' => 'Tn. Technician Hardware',
                'user_name' => 'technician_hardware',
                'user_category' => 1,
                'user_email' => 'technician_hardware@maika-kanaka.com',
                'user_password' => password_hash('123456', PASSWORD_DEFAULT),
                'is_new' => 'N',

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ],

            [
                'group_id' => 2,
                'user_id' => 3,
                'user_fullname' => 'Tn. Technician Software',
                'user_name' => 'technician_software',
                'user_category' => 2,
                'user_email' => 'technician_software@maika-kanaka.com',
                'user_password' => password_hash('123456', PASSWORD_DEFAULT),
                'is_new' => 'N',

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ],

            [
                'group_id' => 2,
                'user_id' => 4,
                'user_fullname' => 'Tn. Technician Network',
                'user_name' => 'technician_network',
                'user_category' => 2,
                'user_email' => 'technician_network@maika-kanaka.com',
                'user_password' => password_hash('123456', PASSWORD_DEFAULT),
                'is_new' => 'N',

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ],

            [
                'group_id' => 3,
                'user_id' => 5,
                'user_fullname' => 'Ny. Requester',
                'user_name' => 'requester',
                'user_category' => NULL,
                'user_email' => 'requester@maika-kanaka.com',
                'user_password' => password_hash('123456', PASSWORD_DEFAULT),
                'is_new' => 'N',

                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ]
        ]);
    }
}
