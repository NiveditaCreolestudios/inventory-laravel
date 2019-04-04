<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	for ($user=0; $user < 10; $user++) { 
	        DB::table('users')->insert([
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'password' => bcrypt('password'),
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ]);
    	}
    }
}
