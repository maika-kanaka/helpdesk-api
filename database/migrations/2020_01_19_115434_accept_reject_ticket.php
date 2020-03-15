<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AcceptRejectTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trx_tickets', function (Blueprint $table) {
            $table->datetime('accepted_at')->nullable();
            $table->integer('accepted_by')->nullable();
            $table->datetime('rejected_at')->nullable();
            $table->integer('rejected_by')->nullable();
            $table->string('rejected_notes', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_tickets', function (Blueprint $table) {
            $table->dropColumn('accepted_at');
            $table->dropColumn('accepted_by');
            $table->dropColumn('rejected_at');
            $table->dropColumn('rejected_by');
            $table->dropColumn('rejected_notes', 255);
        });
    }
}
