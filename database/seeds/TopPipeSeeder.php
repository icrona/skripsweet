<?php

use Illuminate\Database\Seeder;
use App\TopPipe;

class TopPipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TopPipe::truncate();
        foreach (range(0,12) as $index) {
        	TopPipe::create([
                'name'=>'Pipe Top '.($index+1),
        		'image'=>'top'.$index.'.png',
        		'price'=>7000,
        		'availability'=>1
        		]);
        }
    }
}
