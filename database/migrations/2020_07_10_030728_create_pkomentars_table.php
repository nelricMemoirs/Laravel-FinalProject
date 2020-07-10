<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkomentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkomentars', function (Blueprint $table) {
            $table->id();
            $table->text('isi_komentar');
            $table->bigInteger('pertanyaan_id')->unsigned()->nullable();
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaans')->onDelete('cascade');
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
        Schema::dropIfExists('pkomentars');
    }
}
