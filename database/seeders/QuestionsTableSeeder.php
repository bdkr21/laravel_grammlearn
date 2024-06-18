<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            // Adjectives
            [
                'category_id' => '18',
                'question' => 'She is a very happiest girl in the class.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '18',
                'question' => 'The dog is more friendlier than the cat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '18',
                'question' => 'This is the most simplest method to solve the problem..',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '18',
                'question' => 'He is a more smarter student than his brother.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '18',
                'question' => 'Of the two options, the first one is the bestest.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Adverbs
            [
                'category_id' => '19',
                'question' => 'She sings very beautiful.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '19',
                'question' => 'He runs quick to catch the bus.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '19',
                'question' => 'They work hard every day, but they work more hard on Fridays.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '19',
                'question' => 'She speaks English very good.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '19',
                'question' => 'He did the task very careful.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Comparative Adjective Phrases
            [
                'category_id' => '20',
                'question' => 'My car is more faster than yours.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '20',
                'question' => 'This cake is more deliciouser than the one you made last week.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '20',
                'question' => 'Her dress is more prettier than mine.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '20',
                'question' => 'He is more taller than his brother.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '20',
                'question' => 'This puzzle is more easier than the last one.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Comparatives and Superlatives
            [
                'category_id' => '21',
                'question' => 'She is the most happiest person I know.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '21',
                'question' => 'Of the three brothers, Jack is the taller.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '21',
                'question' => 'This restaurant is the most best in town.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '21',
                'question' => 'She is the goodest student in her class.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '21',
                'question' => 'This is the more important issue we need to discuss.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Comparing Quality
            [
                'category_id' => '22',
                'question' => 'This phone is gooder than that one.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '22',
                'question' => 'Her performance was more better than mine.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '22',
                'question' => 'The new model is more efficienter than the old one.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '22',
                'question' => 'This fabric feels more softer than the other one.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '22',
                'question' => 'Of all the paintings, I like this one the bestest.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Comparing Quantity
            [
                'category_id' => '23',
                'question' => 'She has more books than me.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '23',
                'question' => 'There are less people here than expected.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '23',
                'question' => 'He spent fewer money than his friend.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '23',
                'question' => 'I have much homework to do tonight.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => '23',
                'question' => 'She ate less cookies than her brother.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
