<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotAcceptedToResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE bom_responses CHANGE status status ENUM('accepted', 'not accepted', 'pending', 'rejected') DEFAULT 'pending'");
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        DB::statement("ALTER TABLE bom_responses CHANGE status status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending'");
    }
}
