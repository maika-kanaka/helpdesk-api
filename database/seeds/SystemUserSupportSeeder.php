<?php

use Illuminate\Database\Seeder;

class SystemUserSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_user_support')->insert([
            [
                'user_id' => 2,
                'support_id' => 1
            ]
        ]);
    }
}
