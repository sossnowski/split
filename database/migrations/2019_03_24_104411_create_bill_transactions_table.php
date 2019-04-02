<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bill_id')->unsigned();
            $table->integer('bill_participant_id_from')->unsigned();
            $table->integer('bill_participant_id_to')->unsigned();
            $table->integer('amount')->unsigned();
            $table->timestamps();
        });

        Schema::table('bill_transactions', function (Blueprint $table) {
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
        Schema::dropIfExists('bill_transactions');
    }
}
