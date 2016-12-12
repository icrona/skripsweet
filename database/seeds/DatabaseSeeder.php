<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(ShapeSeeder::class);
        $this->call(FrostingSeeder::class);
        $this->call(TopPipeSeeder::class);
        $this->call(EdgePipeSeeder::class);
        $this->call(SprinkleSeeder::class);
        $this->call(DecorationSeeder::class);
    }
}
