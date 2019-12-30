<?php

use Illuminate\Database\Seeder;

class MasterSupportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_supports')->insert([
            'support_name' => 'IT',
            'support_desc' => 'Information Technology',
            'is_active' => 'Y',
            'created_at' => '2000-01-01 00:00:00',
            'created_by' => 0
        ]);
    }
}
