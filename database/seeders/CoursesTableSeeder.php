<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'slug' => 'parts-of-speech',
                'title' => 'Parts of Speech',
                'description' => 'Adjectives adalah kata yang menggambarkan kata benda',
                'completion' => 70,
                'instructor' => 'John Doe',
                'category' => 'Adverbs and Adjectives',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'slug' => 'simple-present-tense',
                'title' => 'Simple Present Tense',
                'description' => 'Adverbs adalah kata yang memodifikasi atau menjelaskan kata kerja',
                'completion' => 50,
                'instructor' => 'Jane Doe',
                'category' => 'Adverbs and Adjectives',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'slug' => 'present-continuous-tense',
                'title' => 'Present Continuous Tense',
                'description' => 'Description for Conditionals with "Unless"',
                'completion' => 30,
                'instructor' => 'John Smith',
                'category' => 'Conditionals',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'slug' => 'simple-past-tense',
                'title' => 'Simple Past Tense',
                'description' => 'Past Tense digunakan ketika Anda ingin membicarakan sesuatu yang telah terjadi di masa lalu',
                'completion' => 80,
                'instructor' => 'Jane Smith',
                'category' => 'Verb Tenses',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
