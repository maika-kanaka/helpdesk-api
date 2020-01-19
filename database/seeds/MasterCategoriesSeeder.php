<?php

use Illuminate\Database\Seeder;

class MasterCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_categories')->insert([
            [
                'support_id' => 1,
                'category_name' => 'Hardware',
                'is_active' => 'Y',
                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ],

            [
                'support_id' => 1,
                'category_name' => 'Software',
                'is_active' => 'Y',
                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ],

            [
                'support_id' => 1,
                'category_name' => 'Network',
                'is_active' => 'Y',
                'created_at' => '2000-01-01 00:00:00',
                'created_by' => 0
            ]
        ]);
    }
}
