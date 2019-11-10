<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemUserLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_user_log', function (Blueprint $table) {

            $table->integer('log_id');
            $table->integer('user_id');
            $table->string('menu_id', 70)->nullable();
            $table->string('id_trx', 120)->nullable();
            $table->string('log_event', 50)->nullable();
            $table->string('log_message', 220)->nullable();
            $table->dateTime('created_at');

            $table->primary('log_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_user_log');
    }
}
