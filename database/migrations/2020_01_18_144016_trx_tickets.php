<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrxTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_tickets', function(Blueprint $table){
            $table->bigIncrements('ticket_id');
            $table->integer('support_id');
            $table->integer('category_id');
            $table->string('ticket_code', 10);
            $table->string('ticket_title', 120);
            $table->string('ticket_priority', 20);
            $table->string('ticket_photo', 20)->nullable();
            $table->text('ticket_desc');
            $table->string('ticket_status', 30);
            $table->string('ticket_last_progress', 30)->nullable();

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
        Schema::drop('trx_tickets');
    }
}
