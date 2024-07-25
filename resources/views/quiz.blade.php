<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} Quiz</title>
    @vite('resources/css/app.css')
    <style>
        .btn-primary {
            background-color: #1d4ed8;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1e40af;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 300px; /* Adjust as needed */
            margin: 0 auto; /* Center the container */
            justify-content: center;
        }
        .card {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #e5e7eb;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card.answered {
            background-color: #34d399; /* Green for answered questions */
        }
        .card.current {
            background-color: #1d4ed8; /* Blue for the current question */
            color: #ffffff;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-number {
            font-size: 18px;
            font-weight: bold;
        }
        #back-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-200">
    <div class="container mx-auto my-12 p-8 bg-white rounded-lg shadow-lg">
        <div class="quiz-header text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">{{ $course->title }} Quiz</h1>
            <p class="text-gray-600">{{ $course->description }}</p>
        </div>

        @if($question)
            <div class="question-card mb-6 p-6 bg-gray-50 rounded-lg shadow-sm">
                <p class="text-xl font-semibold mb-4">Question {{ $questionIndex }}</p>
                <p class="text-lg">{{ $question->question }}</p>

                <form id="quiz-form">
                    @csrf
                    <div class="my-4">
                        @if($options)
                            @foreach($options as $option)
                                <div class="my-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="answer" value="{{ $option }}" class="form-radio"
                                               {{ isset($answers[$questionIndex - 1]) && $answers[$questionIndex - 1] == $option ? 'checked' : '' }}>
                                        <span class="ml-2">{{ $option }}</span>
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <p class="text-red-500">No options available for this question.</p>
                        @endif
                    </div>
                </form>
            </div>
        @else
            <div class="question-card text-center p-6 bg-gray-50 rounded-lg shadow-sm">
                <p class="text-gray-600">No question found.</p>
            </div>
        @endif

        <div class="card-container">
            @for ($i = 1; $i <= $totalQuestions; $i++)
                <a href="{{ route('grammar.quiz.showQuestion', ['course' => $course->slug, 'questionIndex' => $i]) }}" class="card {{ $i == $questionIndex ? 'current' : '' }} {{ isset($answers[$i - 1]) ? 'answered' : '' }}">
                    <div class="card-number">{{ $i }}</div>
                </a>
            @endfor
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('grammar.quiz.finishAttempt', ['course' => $course->slug]) }}" class="btn-primary w-full py-2 text-white rounded-lg">Finish Attempt</a>
        </div>
    </div>
    <div id="scroll-buttons" class="fixed bottom-20 right-20 z-50 flex flex-col items-center space-y-2">
        <button id="back-button" class="bg-gray-500 text-white rounded-full w-12 h-12 shadow-md">Back</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('quiz-form');
            const radios = form.querySelectorAll('input[type="radio"]');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            radios.forEach(radio => {
                radio.addEventListener('change', () => {
                    const formData = new FormData(form);
                    const url = '{{ route('grammar.quiz.saveAnswer', ['course' => $course->slug, 'questionIndex' => $questionIndex]) }}';

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Update the navigation card to show it is answered
                            const card = document.querySelector(`.card-container a:nth-child(${ {{ $questionIndex }} })`);
                            if (card) {
                                card.classList.add('answered');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });

            const backButton = document.getElementById('back-button');
            backButton.addEventListener('click', () => {
                window.history.back();
            });
        });
    </script>
</body>
</html>
