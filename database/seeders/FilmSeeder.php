<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = Genre::all();

        Film::factory(50)->create()->each(
            function ($film) use ($genres){
                $film->genre()->attach(
                    $genres->random(rand(1,2))->pluck('id')->toArray()
                );
            }
        );
    }
}
