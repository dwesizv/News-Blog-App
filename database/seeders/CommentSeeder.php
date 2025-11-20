<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;

class CommentSeeder extends Seeder
{

    function run(): void {
        $faker = \Faker\Factory::create();

        foreach(range(1, 10) as $i) {

            $ids = Blog::pluck('id');
            $ids = $ids->all();
            $position = array_rand($ids);
            $id = $ids[$position];

            DB::table("comment")->insert([
                "idblog"      => $id,
                "commentator" => $faker->unique()->firstName(),
                "content"     => $faker->sentence(16),
            ]);
        }
    }
}