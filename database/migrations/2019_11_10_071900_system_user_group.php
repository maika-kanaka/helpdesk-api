<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemUserGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_user_group', function (Blueprint $table) {
            $table->bigIncrements('group_id');
            $table->string('group_name', 50);
            $table->string('group_desc', 255)->nullable();
            $table->char('is_active', 1)->default('Y');
            
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
        Schema::drop('system_user_group');
    }
}
