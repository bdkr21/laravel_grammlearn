<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('answers')->insert([
            // Pertanyaan 1: Apa itu kata benda (noun)?
            [
                'question_id' => 791,
                'answer_text' => 'Kata benda adalah kata yang merujuk pada orang, tempat, benda, atau ide.',
                'is_correct' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 791,
                'answer_text' => 'Kata benda adalah kata yang menggambarkan tindakan.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 791,
                'answer_text' => 'Kata benda adalah kata yang mengubah kata kerja.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 791,
                'answer_text' => 'Kata benda adalah kata yang menggambarkan tempat.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Pertanyaan 2: Apa itu kata kerja (verb)?
            [
                'question_id' => 792,
                'answer_text' => 'Kata kerja adalah kata yang menggambarkan tindakan atau keadaan.',
                'is_correct' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 792,
                'answer_text' => 'Kata kerja adalah kata yang menggambarkan kata benda.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 792,
                'answer_text' => 'Kata kerja adalah kata yang menggambarkan tempat.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 792,
                'answer_text' => 'Kata kerja adalah kata yang menggambarkan ide.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Pertanyaan 3: Apa itu kata sifat (adjective)?
            [
                'question_id' => 793,
                'answer_text' => 'Kata sifat adalah kata yang menggambarkan kata benda.',
                'is_correct' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 793,
                'answer_text' => 'Kata sifat adalah kata yang menggambarkan kata kerja.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 793,
                'answer_text' => 'Kata sifat adalah kata yang menggambarkan tindakan.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 793,
                'answer_text' => 'Kata sifat adalah kata yang mengubah kata sifat lain.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Pertanyaan 4: Apa itu kata keterangan (adverb)?
            [
                'question_id' => 794,
                'answer_text' => 'Kata keterangan adalah kata yang mengubah kata kerja, kata sifat, atau kata keterangan lainnya.',
                'is_correct' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 794,
                'answer_text' => 'Kata keterangan adalah kata yang merujuk pada orang, tempat, atau benda.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 794,
                'answer_text' => 'Kata keterangan adalah kata yang menggambarkan kata benda.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 794,
                'answer_text' => 'Kata keterangan adalah kata yang menggambarkan tindakan.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Pertanyaan 5: Apa itu kata ganti (pronoun)?
            [
                'question_id' => 795,
                'answer_text' => 'Kata ganti adalah kata yang menggantikan kata benda.',
                'is_correct' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 795,
                'answer_text' => 'Kata ganti adalah kata yang menggambarkan kata kerja.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 795,
                'answer_text' => 'Kata ganti adalah kata yang menggambarkan tempat.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_id' => 795,
                'answer_text' => 'Kata ganti adalah kata yang mengubah kata benda.',
                'is_correct' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
