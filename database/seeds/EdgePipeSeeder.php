<?php

use Illuminate\Database\Seeder;
use App\EdgePipe;

class EdgePipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	EdgePipe::truncate();
        foreach (range(0,14) as $index) {
        	EdgePipe::create([
                'name'=>'Pipe Edge '.($index+1),
        		'image'=>'edge'.$index.'.png',
        		'price'=>7000,
        		'availability'=>1
        		]);
        }
    }
}
