<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $questionsData = $this->generateDummyQuestions($category->title);

            foreach ($questionsData as $questionData) {
                Question::create([
                    'category_id' => $category->id,
                    'question' => $questionData['question'],
                    'answer' => $questionData['answer'],
                ]);
            }
        }
    }

    private function generateDummyQuestions($categoryTitle)
    {
        $questions = [];

        switch (strtolower($categoryTitle)) {
            case 'animals':
                $questions = [
                    ['question' => 'Fill in the blank: The ___ (run) quickly across the field.', 'answer' => 'dog runs'],
                    ['question' => 'Correct the sentence: The cats is playing with the ball.', 'answer' => 'The cats are playing with the ball.'],
                    ['question' => 'Choose the correct form: A group of ___ (lion) is called a pride.', 'answer' => 'lions'],
                    ['question' => 'Fill in the blank: Elephants ___ (be) the largest land animals.', 'answer' => 'are'],
                    ['question' => 'Choose the correct preposition: Birds fly ___ the sky.', 'answer' => 'in'],
                ];
                break;

            case 'food':
                $questions = [
                    ['question' => 'Fill in the blank: She ___ (eat) an apple every morning.', 'answer' => 'eats'],
                    ['question' => 'Correct the sentence: There is many fruits in the basket.', 'answer' => 'There are many fruits in the basket.'],
                    ['question' => 'Choose the correct article: ___ orange is a good source of Vitamin C.', 'answer' => 'An'],
                    ['question' => 'Fill in the blank: They ___ (drink) coffee every evening.', 'answer' => 'drink'],
                    ['question' => 'Choose the correct form: The ___ (tomato) are ripe.', 'answer' => 'tomatoes'],
                ];
                break;

            case 'clothes':
                $questions = [
                    ['question' => 'Fill in the blank: He ___ (wear) a suit to work.', 'answer' => 'wears'],
                    ['question' => 'Correct the sentence: She have a red dress.', 'answer' => 'She has a red dress.'],
                    ['question' => 'Choose the correct form: These ___ (shoe) are new.', 'answer' => 'shoes'],
                    ['question' => 'Fill in the blank: They ___ (put) on their jackets before going out.', 'answer' => 'put'],
                    ['question' => 'Choose the correct preposition: The scarf is ___ the closet.', 'answer' => 'in'],
                ];
                break;

            case 'nature':
                $questions = [
                    ['question' => 'Fill in the blank: The sun ___ (rise) in the east.', 'answer' => 'rises'],
                    ['question' => 'Correct the sentence: Plants needs water to grow.', 'answer' => 'Plants need water to grow.'],
                    ['question' => 'Choose the correct form: The ___ (leaf) are green.', 'answer' => 'leaves'],
                    ['question' => 'Fill in the blank: It ___ (rain) heavily during the monsoon.', 'answer' => 'rains'],
                    ['question' => 'Choose the correct preposition: The river flows ___ the valley.', 'answer' => 'through'],
                ];
                break;

            case 'verbs':
                $questions = [
                    ['question' => 'Choose the correct form: She ___ (run) every morning.', 'answer' => 'runs'],
                    ['question' => 'Fill in the blank: They ___ (be) happy to see us.', 'answer' => 'are'],
                    ['question' => 'Correct the sentence: He do his homework every day.', 'answer' => 'He does his homework every day.'],
                    ['question' => 'Choose the correct form: The children ___ (play) in the park.', 'answer' => 'play'],
                    ['question' => 'Fill in the blank: We ___ (go) to the beach last weekend.', 'answer' => 'went'],
                ];
                break;

            case 'plurals':
                $questions = [
                    ['question' => 'What is the plural form of "child"?', 'answer' => 'children'],
                    ['question' => 'Fill in the blank: There are three ___ (book) on the table.', 'answer' => 'books'],
                    ['question' => 'Choose the correct form: The ___ (mouse) are in the house.', 'answer' => 'mice'],
                    ['question' => 'Fill in the blank: She has two ___ (cat) as pets.', 'answer' => 'cats'],
                    ['question' => 'What is the plural form of "man"?', 'answer' => 'men'],
                ];
                break;

            case 'verb plurals':
                $questions = [
                    ['question' => 'Choose the correct form: They ___ (be) excited about the trip.', 'answer' => 'are'],
                    ['question' => 'Fill in the blank: She ___ (have) many friends.', 'answer' => 'has'],
                    ['question' => 'Correct the sentence: The dogs barks at strangers.', 'answer' => 'The dogs bark at strangers.'],
                    ['question' => 'Fill in the blank: We ___ (do) our homework together.', 'answer' => 'do'],
                    ['question' => 'Choose the correct form: They ___ (eat) lunch at noon.', 'answer' => 'eat'],
                ];
                break;

            case 'professions':
                $questions = [
                    ['question' => 'Fill in the blank: A ___ (teach) works in a school.', 'answer' => 'teacher'],
                    ['question' => 'Choose the correct form: Doctors ___ (help) people who are sick.', 'answer' => 'help'],
                    ['question' => 'Correct the sentence: She is a engineers.', 'answer' => 'She is an engineer.'],
                    ['question' => 'Fill in the blank: A ___ (pilot) flies airplanes.', 'answer' => 'pilot'],
                    ['question' => 'Choose the correct form: Lawyers ___ (give) legal advice.', 'answer' => 'give'],
                ];
                break;

            default:
                break;
        }

        return $questions;
    }
}
