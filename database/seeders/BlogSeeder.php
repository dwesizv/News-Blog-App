<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Genre;

class BlogSeeder extends Seeder
{
    function run(): void {

        $faker = \Faker\Factory::create();

        foreach(range(1, 10) as $i) { // Puede ser que si se hacen much

            // Los inicio fuera porque asi puedo asignarle a la imagen aleatoria el nombre+apellido
            $author = $faker->unique()->firstName();
            $url = 'https://picsum.photos/seed/' . \Illuminate\Support\Str::uuid() . '/600/600.jpg';
            $path = $this->upload($url, $author);

            // Para obtener un array con todos los IDS de genero disponible
            // Y asignar uno aleatorio de los disponibles
            $ids = Genre::pluck('id');
            $ids = $ids->all();
            $position = array_rand($ids);
            $id = $ids[$position];

            DB::table("blog")->insert([
                "author"     => $author,
                "entry"      => $faker->sentence(4),
                "idgenre"    => $id,
                "path"       => $path,
                "text"       => $faker->sentence(16),
                "title"      => $faker->sentence(4),
                'created_at' => '2025/12/04 16:37:15',
                'updated_at' => '2025/12/04 16:37:15',
            ]);
        }
    }

    protected function upload($url, $author) {
        $response = Http::get($url);
        $fileName = $author . "." . "jpg"; // siempre es jpg desde la ruta que usamos para obtener la imagen
        $path = "images/" . $fileName;
        Storage::disk("public")->put($path, $response->body());
        return $path;
    }
}