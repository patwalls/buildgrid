<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoogleFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('users', function ($table) {
    		$table->string('google_id', 32)->after('linkedin_token')->nullable();
    		$table->string('google_token')->after('google_id')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('users', function ($table) {
    		$table->dropColumn('google_token');
    		$table->dropColumn('google_id');
		});
    }
}
