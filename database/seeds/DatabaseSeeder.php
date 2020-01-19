<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SystemMenusSeeder::class);
        $this->call(SystemUserGroupSeeder::class);
        $this->call(SystemUsersSeeder::class);
        $this->call(SystemUserGroupAccessSeeder::class);

        $this->call(MasterSupportsSeeder::class);
        $this->call(MasterCategoriesSeeder::class);
        $this->call(SystemUserSupportSeeder::class);
    }
}
