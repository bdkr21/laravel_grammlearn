<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriController extends Controller
{
        private $grammarTopics = [
            'Adverbs and Adjectives' => [
                ['title' => 'Adjectives', 'description' => 'Adjectives adalah kata yang menggambarkan kata benda dan kata ganti, misalnya, pretty, happy, ugly, atau smart. Adjectives biasanya datang sebelum kata benda, seperti dalam kalimat, "That was a scary movie!"Kadang-kadang, adjectives mengikuti kata kerja, seperti dalam kalimat, "Your baby is very cute." Namun dalam kasus ini, adjective masih memodifikasi subjek kalimat (your baby), bukan kata kerja (is). Ingat, berbeda dengan beberapa bahasa lain, adjectives hanya memiliki satu bentuk dalam bahasa Inggris. Mereka tidak memiliki bentuk tunggal dan jamak atau bentuk maskulin dan feminin. Misalnya, Anda tidak akan mengatakan, "Those girls are beautifuls." Meskipun ada lebih dari satu gadis, Anda tetap akan mengatakan, "Those girls are beautiful." Adjectives terlihat sama tidak peduli kata benda apa yang mereka gambarkan. Adjectives juga digunakan untuk menggambarkan bagaimana seseorang merasa. Adjectives ini sering berakhiran "ed," seperti excited dan pleased. Adjectives of emotion sering mengikuti kata kerja "to be." Misalnya, "Robert is excited to see the new Star Wars movie."'],
                ['title' => 'Adverbs', 'description' => 'Adverbs adalah kata yang memodifikasi atau menjelaskan kata lain. Mereka dapat memodifikasi kata kerja, seperti dalam, "He speaks softly." Atau mereka dapat memodifikasi kata sifat, seperti dalam, "This room is quite large." Atau mereka bahkan dapat memodifikasi adverbia lain, seperti dalam, "He walked very slowly."Anda dapat mengubah banyak kata sifat menjadi adverbia dengan menambahkan -ly di akhir, seperti quietly, quickly, slowly, atau gladly. Tetapi hati-hati! Ini tidak berlaku 100% dari waktu. Misalnya, ini tidak berlaku untuk kata sifat yang sudah berakhiran -y, seperti happy. Bentuk adverbia dari happy adalah happily. Adverbia dapat ditempatkan di awal, tengah, atau akhir kalimat. Anda bisa mengatakan, "Quickly, she ran down the street," atau, "She ran quickly down the street," atau, "She ran down the street quickly." Namun, Anda sebaiknya tidak pernah menempatkan adverbia antara kata kerja dan objeknya. Anda bisa mengatakan, "I hungrily ate an apple," tetapi tidak, "I ate hungrily an apple."'],
                ['title' => 'Comparative Adjective Phrases', 'description' => 'Untuk membandingkan orang, tempat, peristiwa, atau benda yang memiliki kesamaan, gunakan struktur as + adjective + as. Contoh dari perbandingan jenis ini meliputi umur, suhu, sikap, dll. Misalnya, "Amanda is 5 years old, and Tony is 5 years old. Amanda is as old as Tony." Atau "Florida is warm. California is warm. Florida is as warm as California." Kita juga bisa menggunakan as + adjective + as untuk membandingkan orang, tempat, atau benda yang tidak sama. Untuk membuat perbandingan yang tidak setara, tambahkan not sebelum kata as yang pertama. Misalnya, "Megan is not as happy as Sue," atau, "Biking is not as difficult as running."'],
                ['title' => 'Comparatives and Superlatives', 'description' => 'Ada dua cara untuk membentuk comparatives dalam bahasa Inggris. Cara pertama adalah untuk kata sifat panjang, yang memiliki tiga atau lebih suku kata. Dengan kata sifat panjang, kita menggunakan "more" untuk membentuk frasa perbandingan dengan "than". Contohnya, "Sarah is more beautiful than Martha."Cara kedua adalah untuk kata sifat pendek, yang memiliki satu atau dua suku kata. Dengan kata sifat pendek, kita menambahkan "-er" di akhir kata, seperti dalam kalimat, "Jacob is smarter than Ed." Untuk kata sifat pendek yang berakhiran huruf "y", seperti "happy," kita menghilangkan huruf "y" dan menambahkan "-ier". Contohnya, "Lucy is happier than Rob."Sama halnya, kita membentuk superlatives dengan dua cara berbeda, tergantung pada panjang kata sifat. Dengan kata sifat panjang, kita menggunakan "the most", seperti dalam kalimat "He is the most intelligent person I know." Dengan kata sifat pendek, kita menambahkan "-est" di akhir kata. Contohnya, "Johnny is the fastest runner on the team." Untuk kata sifat pendek yang berakhiran huruf "y", kita menghilangkan huruf "y" dan menambahkan "-iest", seperti dalam kalimat, "She is the prettiest girl in the world."'],
                ['title' => 'Comparing Quality', 'description' => 'Ada beberapa cara yang berbeda untuk membuat perbandingan kualitas dalam bahasa Inggris. Dengan kata sifat satu suku kata atau kata yang berakhiran -y atau -ly, tambahkan sufiks -er atau -ier untuk membentuk frasa perbandingan dengan "than". Contohnya, "This apple is redder than that one," atau "My bag is heavier than yours." Dengan kata sifat atau kata keterangan yang memiliki lebih dari satu suku kata, gunakan "more" atau "less" untuk membuat frasa perbandingan dengan "than". Contohnya, "This dress is more beautiful than that one," atau "These flowers are less colorful than those flowers." Untuk menunjukkan bahwa dua hal memiliki kualitas yang sama, gunakan "as...as" untuk membandingkan aspek-aspek yang sama dari kualitas (kata sifat) atau cara (kata keterangan) dari dua hal tersebut. Anda bisa mengatakan, "My bicycle is as fast as your bicycle," atau "My dog runs as quickly as Your dog"'],
                ['title' => 'Comparing Quantity', 'description' => 'Ada beberapa cara yang berbeda untuk membuat perbandingan kuantitas dalam bahasa Inggris. Dengan kata benda tak terhitung seperti kopi, roti, atau cinta, kita menggunakan "more than" dan "less than". Contohnya: "My mother loves me more than she loves my sister," atau, "There is less ice cream in my bowl than in Sarah’s bowl."Untuk kata benda yang dapat dihitung seperti apel, orang, atau buku, kita menggunakan "more than" dan "fewer than" untuk membuat perbandingan kuantitas. Contohnya: "I have more books than my brother," atau, "Jake has fewer friends than Paul."Untuk menunjukkan bahwa dua hal memiliki kuantitas yang sama, kita menggunakan "as much as", "as many as", atau "as little as" untuk kata benda tak terhitung. Contohnya: "Jason is taking as many classes this year as he did last year," atau "I use as little milk in my coffee as you do."Untuk kata benda yang dapat dihitung, kita menggunakan "as many as" dan "as few as". Seperti dalam kalimat, "I can eat as many cookies as you can," atau, "There are as few people at this movie as there were at the last movie we saw."']
            ],
            'Conditionals' => [
                ['title' => 'Conditionals with "Unless"'],
                ['title' => 'First Conditional'],
                ['title' => 'Second Conditional'],
                ['title' => 'Second Conditional Progressive'],
                ['title' => 'The Unreal Past'],
                ['title' => 'Third Conditional'],
                ['title' => 'Third Conditional Progressive'],
                ['title' => 'Zero Conditional']
            ],
            'Verb Tenses' => [
                ['title' => 'Future in the Past', 'description' => 'Future in the past digunakan ketika Anda ingin membicarakan sesuatu di masa lalu yang Anda pikir akan terjadi di masa depan. Tidak masalah apakah hal tersebut benar-benar terjadi atau tidak. Anda menggunakan future in the past untuk membahas rencana atau janji dari masa lalu.Ada dua cara untuk membentuk future in the past. Salah satu caranya adalah dengan menggunakan was/were going to + verb, seperti dalam kalimat, "He was going to go to the movies last Friday night." Pada suatu titik di masa lalu, dia memiliki rencana untuk pergi ke bioskop Jumat malam lalu. "Last Friday night" adalah waktu antara saat dia membuat rencana dan sekarang.Anda juga bisa menggunakan would untuk membentuk future in the past. Gunakan would + verb ketika Anda membicarakan sesuatu di masa lalu yang seseorang janjikan atau tawarkan untuk dilakukan. Misalnya, Anda bisa mengatakan, "He said he would call when he arrived." Jika panggilan terjadi, itu terjadi setelah dia mengatakan akan menelepon.'],
                ['title' => 'Future Perfect Tense'],
                ['title' => 'Future Progressive Tense'],
                ['title' => 'Past Perfect Progressive'],
                ['title' => 'Past Perfect Tense'],
                ['title' => 'Past Progressive Tense'],
                ['title' => 'Present Perfect Progressive'],
                ['title' => 'Present Perfect Tense'],
                ['title' => 'Present Progressive Tense'],
                ['title' => 'Simple Future Tense'],
                ['title' => 'Simple Past Tense'],
                ['title' => 'Simple Present Tense']
            ]
            // 'Other Verb Forms' => [
            //     ['title' => 'Be Able To'],
            //     ['title' => 'Direct vs. Reported Speech'],
            //     ['title' => 'Gerunds vs. Infinitives'],
            //     ['title' => 'Imperative Form'],
            //     ['title' => 'Modal Verbs'],
            //     ['title' => 'Passive Voice'],
            //     ['title' => 'Phrasal Verbs'],
            //     ['title' => 'Reflexive Pronouns'],
            //     ['title' => 'Split Infinitives'],
            //     ['title' => 'Tag Questions'],
            //     ['title' => 'Used to Do vs Be Used to'],
            //     ['title' => 'Verbs with "-ing"']
            // ],
            // 'Other Grammar Points' => [
            //     ['title' => 'Articles, Quantifiers, and Determiners'],
            //     ['title' => 'Conjunctions'],
            //     ['title' => 'Contractions and Abbreviations'],
            //     ['title' => 'Count and Noncount Nouns'],
            //     ['title' => 'Definite & Indefinite Articles'],
            //     ['title' => 'It’s vs. Its'],
            //     ['title' => 'Plural vs. Possessive "S"'],
            //     ['title' => 'Possessive Adjectives'],
            //     ['title' => 'Possessive Pronouns'],
            //     ['title' => 'Prepositions'],
            //     ['title' => 'Relative Pronouns'],
            //     ['title' => 'There, Their & They\'re'],
            //     ['title' => 'To, Too & Two'],
            //     ['title' => 'You’re vs. Your']
            // ]
        ];
    public function index()
    {
        return view('materi.index', ['grammarTopics' => $this->grammarTopics]);
    }

    public function show($topic)
    {
        foreach ($this->grammarTopics as $category => $topics) {
            foreach ($topics as $t) {
                if (strtolower($t['title']) == strtolower($topic)) {
                    return response()->json($t);
                }
            }
        }
        return response()->json(['error' => 'Topic not found'], 404);
    }
}
