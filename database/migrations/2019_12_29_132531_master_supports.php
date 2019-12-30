<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterSupports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_supports', function (Blueprint $table) {
            $table->bigIncrements('support_id');
            $table->string('support_name', 70);
            $table->string('support_desc', 220)->nullable();
            $table->char('is_active', 1)->default('Y');

            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('created_at');
            $table->integer('created_by')->nullable();
        });

        Schema::create('system_user_support', function (Blueprint $table) {
            $table->bigInteger('user_id');
            $table->integer('support_id');

            $table->primary(['user_id', 'support_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('master_supports');

        Schema::drop('system_user_support');
    }
}
