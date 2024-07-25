<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Sample question 1
        $question1 = DB::table('questions')->insertGetId([
            'question' => 'What part of speech is the word "quickly" in the sentence "She runs quickly"?',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('options')->insert([
            ['question_id' => $question1, 'option' => 'Noun', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question1, 'option' => 'Adverb', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question1, 'option' => 'Adjective', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question1, 'option' => 'Verb', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sample question 2
        $question2 = DB::table('questions')->insertGetId([
            'question' => 'Identify the part of speech of the word "happy" in the sentence "He is happy."',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('options')->insert([
            ['question_id' => $question2, 'option' => 'Noun', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question2, 'option' => 'Adverb', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question2, 'option' => 'Adjective', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question2, 'option' => 'Verb', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sample question 3
        $question3 = DB::table('questions')->insertGetId([
            'question' => 'Which part of speech does the word "under" belong to in the sentence "The cat is under the table"?',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('options')->insert([
            ['question_id' => $question3, 'option' => 'Preposition', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question3, 'option' => 'Adverb', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question3, 'option' => 'Adjective', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => $question3, 'option' => 'Conjunction', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Add more questions and options as needed
    }
}
