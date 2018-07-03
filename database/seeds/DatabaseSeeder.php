<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	\App\Product::truncate();
    	(new Faker\Generator)->seed(123);
        factory(App\Product::class,50)->create();
    }
}
