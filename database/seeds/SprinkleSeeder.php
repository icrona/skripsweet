<?php

use Illuminate\Database\Seeder;
use App\Sprinkle;

class SprinkleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Sprinkle::truncate();
        foreach (range(0,1) as $index) {
        	Sprinkle::create([
                'name'=>'Sprinkles '.($index+1),
        		'image'=>'sprinkles'.$index.'.png',
        		'price'=>7000,
        		'availability'=>1
        		]);
        }
    }
}
