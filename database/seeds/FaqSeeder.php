<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::truncate();
        $faker = Faker::create();
    	foreach (range(1,15) as $index) {
	        DB::table('faqs')->insert([
	            'question' => $faker->sentence,
	            'answer' => $faker->sentence,
	        ]);
        }
    }
}
