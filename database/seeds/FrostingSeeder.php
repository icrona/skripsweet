<?php

use Illuminate\Database\Seeder;
use App\Frosting;

class FrostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Frosting::truncate();
        $name=['Butter Cream','Icing','Ganache'];
        $one=[13000,21500,33000];
        $two=[15000,23000,0];
        $three=[17500,25000,0];
        $four=[20000,26500,0];
        foreach (range(0,2) as $index) {
        	Frosting::create([
                'name'=>$name[$index],
                'one'=>$one[$index],
                'two'=>$two[$index],
                'three'=>$three[$index],
                'four'=>$four[$index],
        		'availability'=>1
        		]);
        }
    }
}
