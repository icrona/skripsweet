<?php

use Illuminate\Database\Seeder;
use App\Shape;

class ShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shape::truncate();
        $shape=['Round','Square','Heart'];
        foreach (range(0,2) as $index) {
        	Shape::create([
                'name'=>$shape[$index],
        		'availability'=>1
        		]);
        }
    }
}
