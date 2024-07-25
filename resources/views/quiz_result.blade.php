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
        <h1 class="text-3xl font-bold text-blue-600 mb-4">{{ $course->title }} Quiz Result</h1>
        <p class="text-lg">Congratulations! You have completed the quiz.</p>
        <div class="text-xl font-semibold mt-4">Your score: {{ $score }} out of {{ $totalQuestions }}</div>
        <div class="text-lg mt-2 mb-6">Total points: {{ $points }}</div>

        <ul class="space-y-4">
            @foreach($questions as $index => $question)
                @php
                    $isCorrect = isset($answers[$index]) && $answers[$index] === $question->correct_answer;
                @endphp
                <li class="p-4 bg-gray-50 border rounded-lg hover:shadow-lg transition-shadow">
                    <strong class="block text-lg">{{ $index + 1 }}. {{ $question->question }}</strong>
                    <span class="block mt-2">Your answer:
                        <span class="{{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                            {{ $answers[$index] ?? 'No answer' }}
                        </span>
                    </span>
                    <span class="block mt-1">Correct answer:
                        <span class="{{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                            {{ $question->correct_answer ?? 'No correct answer available' }}
                        </span>
                    </span>
                    <span class="block mt-1">Result:
                        <span class="{{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                            {{ $isCorrect ? 'OK' : 'Salah' }}
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>

        <div class="text-lg mt-6">Points earned in this quiz: {{ $pointsEarned }}</div>

        <a href="{{ route('quiz') }}" class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
            Back to Courses
        </a>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
