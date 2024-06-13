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
                'title' => 'Animals',
                'slug' => 'animals',
                'required_points' => 0, // Gratis
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Food',
                'slug' => 'food',
                'required_points' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Clothes',
                'slug' => 'clothes',
                'required_points' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nature',
                'slug' => 'nature',
                'required_points' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Verbs',
                'slug' => 'verbs',
                'required_points' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Plurals',
                'slug' => 'plurals',
                'required_points' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Verb Plurals',
                'slug' => 'verb-plurals',
                'required_points' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Professions',
                'slug' => 'professions',
                'required_points' => 700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
