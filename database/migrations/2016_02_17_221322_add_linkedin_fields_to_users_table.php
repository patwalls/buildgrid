<?php

use Illuminate\Database\Migrations\Migration;

class AddLinkedinFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function ($table) {
    		$table->string('linkedin_id', 16)->after('remember_token')->nullable();
    		$table->string('linkedin_token')->after('linkedin_id')->nullable();
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
    		$table->dropColumn('linkedin_token');
    		$table->dropColumn('linkedin_id');
		});
    }
}
