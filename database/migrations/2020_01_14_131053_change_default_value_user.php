<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDefaultValueUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_users', function (Blueprint $table) {
            $table->integer('group_id')->nullable()->change();
            $table->char('user_description', 255)->nullable();
            $table->char('user_photo', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_users', function (Blueprint $table) {
            $table->dropColumn(['user_description', 'user_photo']);
        });
    }
}
