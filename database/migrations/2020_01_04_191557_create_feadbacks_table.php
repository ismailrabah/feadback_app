<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeadbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feadbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('not');
            $table->text('commant');// [commant size(10>10000)
            $table->string('title', 255);// [title size(255)
            $table->string('comand_num', 10);// [comand_num size(10)
            $table->boolean("is_private");
            $table->date('exp_date_start');
            $table->date('exp_date_fin');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('feadbacks');
    }
}
