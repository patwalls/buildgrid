<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrators')->insert([
            'name' => 'Administrator',
            'username' => 'admin@kingtidecreative.com',
            'password' => bcrypt('kingtide1'),
        ]);
    }
}
