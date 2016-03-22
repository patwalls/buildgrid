<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // if( App::environment() === 'local' )
      // {
      DB::table('users')->insert([
        'first_name' => 'Demo',
        'last_name' => 'User',
        'email' => 'demo@kingtidecreative.com',
        'phone' => '888-888-8888',
        'company_name' => 'King Tide Creative',
        'position_title' => 'Demo User',
        'password' => bcrypt('kingtide1')
       ]);
      // } 
    }
}
