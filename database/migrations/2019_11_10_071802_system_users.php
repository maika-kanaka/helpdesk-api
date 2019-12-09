<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->integer('group_id');
            $table->string('user_fullname', 120)->nullable();
            $table->string('user_name', 30);
            $table->string('user_email', 120);
            $table->string('user_password', 220);
            $table->char('is_new', 1)->default('Y');
            $table->char('is_reset_password', 1)->default('N');
            $table->char('is_block', 1)->default('N');
            $table->char('_token', 1)->default('N'); // token for reset password, confirm email etc

            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('created_at');
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_users');
    }
}
