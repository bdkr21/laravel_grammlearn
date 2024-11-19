{{-- quiz_result.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} Quiz Result</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">Hasil Kuis {{ $course->title }} </h1>
        <p class="text-lg">Selamat kamu telah menyelesaikan kuis ini.</p>
        <div class="text-xl font-semibold mt-4">Score kamu adalah: {{ $score }} dari {{ $totalQuestions }} soal</div>
        <br>
            <ul class="space-y-4">
                @foreach($questions as $index => $question)
                    @php
                        // Mengambil jawaban pengguna dan jawaban yang benar
                        $userAnswer = $userAnswers[$index + 1] ?? 'No answer';
                        $correctAnswer = $correctedAnswers[$index] ?? null;
                        $isCorrect = $userAnswer === $correctAnswer;
                    @endphp
                    <li class="p-4 border rounded-lg cursor-pointer hover:shadow-lg transition-shadow
                        {{ $isCorrect ? 'bg-green-100 border-green-500' : 'bg-red-100 border-red-500' }}"
                        onclick="toggleDetails(this)">
                        <strong class="block text-lg">{{ $index + 1 }}. {{ $question->question }}</strong>
                        <div class="details hidden mt-2">
                            <span class="block">Jawaban anda:
                                <span class="{{ $isCorrect ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}">
                                    {{ $userAnswer }}
                                </span>
                            </span>
                            <span class="block">jawaban yang benar:
                                <span class="text-green-600">
                                    {{ $correctAnswer ?? 'No correct answer' }}
                                </span>
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>


        <div class="text-lg mt-6">Points earned in this quiz: {{ $pointsEarned }}</div>

        <a href="{{ route('quiz.finish', ['course' => $course->slug]) }}"
            class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
             Back to Courses
         </a>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleDetails(card) {
            const details = card.querySelector('.details');
            if (details) {
                details.classList.toggle('hidden'); // Menambahkan/menghapus kelas "hidden"
            }
        }
    </script>
</body>
</html>
