<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $grammarTopics = [
        'Adverbs and Adjectives' => [
            [
                'title' => 'Adjectives',
                'description' => 'Adjectives adalah kata yang menggambarkan kata benda dan kata ganti, misalnya, pretty, happy, ugly, atau smart. Adjectives biasanya datang sebelum kata benda, seperti dalam kalimat, "That was a scary movie!"Kadang-kadang, adjectives mengikuti kata kerja, seperti dalam kalimat, "Your baby is very cute." Namun dalam kasus ini, adjective masih memodifikasi subjek kalimat (your baby), bukan kata kerja (is). Ingat, berbeda dengan beberapa bahasa lain, adjectives hanya memiliki satu bentuk dalam bahasa Inggris. Mereka tidak memiliki bentuk tunggal dan jamak atau bentuk maskulin dan feminin. Misalnya, Anda tidak akan mengatakan, "Those girls are beautifuls." Meskipun ada lebih dari satu gadis, Anda tetap akan mengatakan, "Those girls are beautiful." Adjectives terlihat sama tidak peduli kata benda apa yang mereka gambarkan. Adjectives juga digunakan untuk menggambarkan bagaimana seseorang merasa. Adjectives ini sering berakhiran "ed," seperti excited dan pleased. Adjectives of emotion sering mengikuti kata kerja "to be." Misalnya, "Robert is excited to see the new Star Wars movie."',
                'description_preview' => 'Adjectives adalah kata yang menggambarkan kata benda dan kata ganti.'
            ],
            [
                'title' => 'Adverbs',
                'description' => 'Adverbs adalah kata yang memodifikasi atau menjelaskan kata lain. Mereka dapat memodifikasi kata kerja, seperti dalam, "He speaks softly." Atau mereka dapat memodifikasi kata sifat, seperti dalam, "This room is quite large." Atau mereka bahkan dapat memodifikasi adverbia lain, seperti dalam, "He walked very slowly."Anda dapat mengubah banyak kata sifat menjadi adverbia dengan menambahkan -ly di akhir, seperti quietly, quickly, slowly, atau gladly. Tetapi hati-hati! Ini tidak berlaku 100% dari waktu. Misalnya, ini tidak berlaku untuk kata sifat yang sudah berakhiran -y, seperti happy. Bentuk adverbia dari happy adalah happily. Adverbia dapat ditempatkan di awal, tengah, atau akhir kalimat. Anda bisa mengatakan, "Quickly, she ran down the street," atau, "She ran quickly down the street," atau, "She ran down the street quickly." Namun, Anda sebaiknya tidak pernah menempatkan adverbia antara kata kerja dan objeknya. Anda bisa mengatakan, "I hungrily ate an apple," tetapi tidak, "I ate hungrily an apple."',
                'description_preview' => 'Adverbs adalah kata yang memodifikasi atau menjelaskan kata lain.'
            ],
            // Tambahkan deskripsi singkat untuk topik lainnya
            // ...
        ],
        'Conditionals' => [
            [
                'title' => 'Conditionals with "Unless"',
                'description' => 'Description for Conditionals with "Unless"',
                'description_preview' => 'Description preview for Conditionals with "Unless"'
            ],
            // Tambahkan deskripsi singkat untuk topik lainnya
            // ...
        ],
        'Verb Tenses' => [
            [
                'title' => 'Future in the Past',
                'description' => 'Future in the past digunakan ketika Anda ingin membicarakan sesuatu di masa lalu yang Anda pikir akan terjadi di masa depan. Tidak masalah apakah hal tersebut benar-benar terjadi atau tidak. Anda menggunakan future in the past untuk membahas rencana atau janji dari masa lalu.Ada dua cara untuk membentuk future in the past. Salah satu caranya adalah dengan menggunakan was/were going to + verb, seperti dalam kalimat, "He was going to go to the movies last Friday night." Pada suatu titik di masa lalu, dia memiliki rencana untuk pergi ke bioskop Jumat malam lalu. "Last Friday night" adalah waktu antara saat dia membuat rencana dan sekarang.Anda juga bisa menggunakan would untuk membentuk future in the past. Gunakan would + verb ketika Anda membicarakan sesuatu di masa lalu yang seseorang janjikan atau tawarkan untuk dilakukan. Misalnya, Anda bisa mengatakan, "He said he would call when he arrived." Jika panggilan terjadi, itu terjadi setelah dia mengatakan akan menelepon.',
                'description_preview' => 'Future in the past digunakan ketika Anda ingin membicarakan sesuatu di masa lalu yang Anda pikir akan terjadi di masa depan.'
            ],
            // Tambahkan deskripsi singkat untuk topik lainnya
            // ...
        ]
    ];

    public function index() {
        return view('courses.index', ['grammarTopics' => $this->grammarTopics]);
    }
}
