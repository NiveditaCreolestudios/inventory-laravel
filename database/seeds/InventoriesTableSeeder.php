<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;
use Faker\Factory as Faker;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
    	for ($inventory=0; $inventory < 100; $inventory++) { 
	        DB::table('inventories')->insert([
	            'item' => ($inventory%2==0?'cell-phone':'car'),
	            'model' => Str::random(10),
	            'model_year' => $faker->year,
	            'quantity_available' => rand(10,50),
	            'price' => rand(10,100),
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now(),
	        ]);
    	}
    }
}
