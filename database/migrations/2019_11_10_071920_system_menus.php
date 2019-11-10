<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SystemMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_menus', function (Blueprint $table) {
            $table->string('menu_id', 70);
            $table->string('menu_id_top', 70)->nullable();
            $table->string('menu_name', 70);
            $table->string('menu_desc', 220)->nullable();
            $table->integer('menu_order')->default(0);
            $table->char('is_active', 1)->default('Y');
            
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('created_at');
            $table->integer('created_by')->nullable();

            $table->primary('menu_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('system_menus');
    }
}
