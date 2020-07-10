<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJkomentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jkomentars', function (Blueprint $table) {
            $table->id();
            $table->text('isi_komentar');
            $table->bigInteger('jawaban_id')->unsigned()->nullable();
            $table->foreign('jawaban_id')->references('id')->on('jawabans')->onDelete('cascade');
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('jkomentars');
    }
}
