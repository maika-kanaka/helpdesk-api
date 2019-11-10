<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemUserGroupAccess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_user_group_access', function (Blueprint $table) {
            $table->integer('group_id');
            $table->string('menu_id', 70);
            $table->char('can_access', 1)->default('Y');

            $table->primary(['group_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_user_group_access');
    }
}
