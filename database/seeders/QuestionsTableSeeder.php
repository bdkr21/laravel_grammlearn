<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Question;


class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            // Generate dummy questions for each category
            $questionsData = $this->generateDummyQuestions($category->id);

            // Insert questions into database
            foreach ($questionsData as $questionData) {
                Question::create([
                    'category_id' => $category->id,
                    'question' => $questionData['question'],
                    // 'options' => json_encode($questionData['options']),
                    'answer' => $questionData['answer'],
                ]);
            }
        }
    }

    // Function to generate dummy questions (adjust as per your needs)
    private function generateDummyQuestions($categoryId)
    {
        // Dummy data example
        $questions = [
            [
                'question' => 'What is the plural form of "cat"?',
                'answer' => 'cats',
            ],
            [
                'question' => 'What is the plural form of "dog"?',
                'answer' => 'dogs',
            ],
            [
                'question' => 'What is the plural form of "car"?',
                'answer' => 'cars',
            ],
            [
                'question' => 'What is the plural form of "tree"?',
                'answer' => 'trees',
            ],
            [
                'question' => 'What is the plural form of "house"?',
                'answer' => 'houses',
            ],
            [
                'question' => 'What is the plural form of "child"?',
                'answer' => 'children',
            ],
            [
                'question' => 'What is the plural form of "mouse"?',
                'answer' => 'mice',
            ],
            [
                'question' => 'What is the plural form of "foot"?',
                'answer' => 'feet',
            ],
            [
                'question' => 'What is the plural form of "goose"?',
                'answer' => 'geese',
            ],
            [
                'question' => 'What is the plural form of "tooth"?',
                'answer' => 'teeth',
            ],
            [
                'question' => 'What is the plural form of "man"?',
                'answer' => 'men',
            ],
            [
                'question' => 'What is the plural form of "woman"?',
                'answer' => 'women',
            ],
            [
                'question' => 'What is the plural form of "person"?',
                'answer' => 'people',
            ],
            [
                'question' => 'What is the plural form of "fish"?',
                'answer' => 'fish',
            ],
            [
                'question' => 'What is the plural form of "sheep"?',
                'answer' => 'sheep',
            ],
            [
                'question' => 'What is the plural form of "deer"?',
                'answer' => 'deer',
            ],
            [
                'question' => 'What is the plural form of "moose"?',
                'answer' => 'moose',
            ],
            [
                'question' => 'What is the plural form of "child"?',
                'answer' => 'children',
            ],
            [
                'question' => 'What is the plural form of "ox"?',
                'answer' => 'oxen',
            ],
            [
                'question' => 'What is the plural form of "cactus"?',
                'answer' => 'cacti',
            ],
            [
                'question' => 'What is the plural form of "fungus"?',
                'answer' => 'fungi',
            ],
            [
                'question' => 'What is the plural form of "nucleus"?',
                'answer' => 'nuclei',
            ],
            [
                'question' => 'What is the plural form of "syllabus"?',
                'answer' => 'syllabi',
            ],
            [
                'question' => 'What is the plural form of "crisis"?',
                'answer' => 'crises',
            ],
            [
                'question' => 'What is the plural form of "thesis"?',
                'answer' => 'theses',
            ],
            [
                'question' => 'What is the plural form of "analysis"?',
                'answer' => 'analyses',
            ],
            [
                'question' => 'What is the plural form of "diagnosis"?',
                'answer' => 'diagnoses',
            ],
            [
                'question' => 'What is the plural form of "hypothesis"?',
                'answer' => 'hypotheses',
            ],
            [
                'question' => 'What is the plural form of "oasis"?',
                'answer' => 'oases',
            ],
            [
                'question' => 'What is the plural form of "phenomenon"?',
                'answer' => 'phenomena',
            ],
            // Add more questions as needed
        ];

        return $questions;
    }
}
