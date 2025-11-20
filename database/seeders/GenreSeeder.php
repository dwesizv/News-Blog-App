<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{

    function run(): void {
        $faker = \Faker\Factory::create();

        foreach(range(1, 10) as $i) {

            DB::table("genre")->insert([
                "name" => $faker->unique()->word(),
            ]);
        }
    }
}