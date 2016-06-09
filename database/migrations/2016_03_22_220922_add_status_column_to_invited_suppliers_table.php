<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnToInvitedSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invited_suppliers', function (Blueprint $table) {
            $table->enum('status', ['notViewed', 'viewed', 'responded'])
                ->default('notViewed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invited_suppliers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
