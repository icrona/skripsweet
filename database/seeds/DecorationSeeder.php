<?php

use Illuminate\Database\Seeder;
use App\Decoration;

class DecorationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Decoration::truncate();
        foreach (range(0,10) as $index) {
       	Decoration::create([
                'name'=>'Candle '.($index),
        		'image'=>'candle'.$index.'.png',
        		'price'=>7000,
        		'availability'=>1
        		]);
        }

        foreach (range(1,14) as $index) {
       	Decoration::create([
                'name'=>'Figure '.($index),
        		'image'=>'figure'.$index.'.png',
        		'price'=>7000,
        		'availability'=>1
        		]);
        }
    }
}
