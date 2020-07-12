<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUseridUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pertanyaans', function($table){
            $table->integer('user_id');
        });
        Schema::table('jawabans', function ($table) {
            $table->integer('user_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pertanyaans', function($table){
            $table->dropColumn('user_id');
        });
        Schema::table('jawabans', function ($table) {
            $table->dropColumn('user_id');

        });
    }
}
