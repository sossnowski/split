<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyBillParticipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_participants', function (Blueprint $table) {
            $table->foreign('bill_participant_id_owner')->references('id')->on('bill_participants')->onDelete('cascade');
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
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
            $table->dropForeign(['bill_participant_id_owner']);
            $table->dropForeign(['bill_id']);
        });
    }
}
