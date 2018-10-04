<?php

use Illuminate\Database\Seeder;

class ExampleChildrenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\ExampleChildren::class, 5)->create();
    }
}
