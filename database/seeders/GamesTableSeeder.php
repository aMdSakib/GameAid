<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            ['name' => 'The Legend of Zelda: Breath of the Wild', 'image_path' => 'zelda.jpg'],
            ['name' => 'Super Mario Odyssey', 'image_path' => 'mario.jpg'],
            ['name' => 'God of War', 'image_path' => 'gow.jpg'],
            ['name' => 'Red Dead Redemption 2', 'image_path' => 'rdr2.jpg'],
            ['name' => 'Minecraft', 'image_path' => 'minecraft.jpg'],
        ];

        foreach ($games as $game) {
            DB::table('games')->insert([
                'name' => $game['name'],
                'image_path' => $game['image_path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
