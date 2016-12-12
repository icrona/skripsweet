<?php

use Illuminate\Database\Seeder;
use App\Version;

class VersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Version::create([
        	'version' => 'Initial Version'
        	]);
        	
    }
}
