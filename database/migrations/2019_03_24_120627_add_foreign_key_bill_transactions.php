<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyBillTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_transactions', function (Blueprint $table) {
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
            $table->foreign('bill_participant_id_from')->references('id')->on('bill_participants')->onDelete('cascade');
            $table->foreign('bill_participant_id_to')->references('id')->on('bill_participants')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_transactions', function (Blueprint $table) {
            $table->dropForeign(['bill_participant_id_from']);
            $table->dropForeign(['bill_participant_id_to']);
        });
    }
}
