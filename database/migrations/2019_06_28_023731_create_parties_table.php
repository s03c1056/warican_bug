<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('detail')->nullable();
            $table->string('url')->nullable();
            $table->integer('start_time')->nullable();
            $table->integer('end_time')->nullable();
            $table->integer('partyPrice')->nullable();
            $table->integer('totalPrice')->nullable();
            $table->integer('change')->nullable();
            
            //とみまつ追加、将来的にnullabeleは削除する//////////////////////////////////
            $table->string('_key')->nullabele();
            //ここまで
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parties');
    }
}
