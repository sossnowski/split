<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('bill_id');
            $table->string('name');
            $table->unsignedBigInteger('amount');
            $table->boolean('is_confirmed');
            $table->unsignedInteger('bill_participant_id_owner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_participants');
    }
}
