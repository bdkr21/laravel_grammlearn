<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'title' => 'Parts of Speech',
                'description' => 'Adjectives adalah kata yang menggambarkan kata benda dan kata ganti...',
                'completion' => 70,
                'instructor' => 'John Doe',
                'category' => 'Adverbs and Adjectives',
                'slug' => Str::slug('Parts of Speech', '-')
            ],
            [
                'title' => 'Simple Present Tense',
                'description' => 'Adverbs adalah kata yang memodifikasi atau menjelaskan kata lain...',
                'completion' => 50,
                'instructor' => 'Jane Doe',
                'category' => 'Adverbs and Adjectives',
                'slug' => Str::slug('Simple Present Tense', '-')
            ],
            [
                'title' => 'Present Continuous Tense',
                'description' => 'Description for Conditionals with "Unless"',
                'completion' => 30,
                'instructor' => 'John Smith',
                'category' => 'Conditionals',
                'slug' => Str::slug('Present Continuous Tense', '-')
            ],
            [
                'title' => 'Simple Past Tense',
                'description' => 'Past Tense digunakan ketika Anda ingin membicarakan sesuatu di masa lalu...',
                'completion' => 80,
                'instructor' => 'Jane Smith',
                'category' => 'Verb Tenses',
                'slug' => Str::slug('Simple Past Tense', '-')
            ],
        ]);
    }
}
