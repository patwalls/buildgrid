<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBomResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bom_id')->unsigned();
            $table->integer('invited_supplier_id')->unsigned();
            $table->string('filename');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('bom_id')->references('id')->on('boms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bom_responses');
    }
}
