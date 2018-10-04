<?php

use Illuminate\Database\Seeder;

class ExampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Example::class, 5)->create();
    }
}
