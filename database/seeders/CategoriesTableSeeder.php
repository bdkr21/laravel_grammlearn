<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => 'Adjectives',
                'slug' => 'adjectives',
                'required_points' => 0, // Gratis
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Adverbs',
                'slug' => 'adverbs',
                'required_points' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comparative Adjective Phrases',
                'slug' => 'comparative-adjective-phrases',
                'required_points' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comparatives and Superlatives',
                'slug' => 'comparatives-and-superlatives',
                'required_points' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comparing Quality',
                'slug' => 'comparing-quality',
                'required_points' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comparing Quantity',
                'slug' => 'comparing-quantity',
                'required_points' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
