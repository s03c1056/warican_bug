<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('party_id');
            $table->integer('user_id');
            $table->text('user_name');
            $table->string('kanji_flag');
            $table->integer('attend_flag');
            $table->integer('drink_flag');
            $table->integer('checkInTime')->nullable();
            $table->integer('earlyCheck')->nullable();
            $table->float('handicap')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('party_users');
    }
}
