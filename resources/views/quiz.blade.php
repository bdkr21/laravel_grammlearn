{{-- quiz.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} Quiz</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: Arial, sans-serif; /* Menggunakan font yang lebih bersih */
        }
        .container {
            max-width: 800px; /* Membatasi lebar maksimum */
            margin: auto; /* Mengatur margin otomatis untuk pusat */
            padding: 20px; /* Menambahkan padding */
        }
        .quiz-header h1 {
            margin-bottom: 10px; /* Menambahkan margin bawah */
        }
        .question-card {
            padding: 20px; /* Menambahkan padding lebih pada kartu pertanyaan */
            border: 1px solid #ddd; /* Menambahkan border */
            border-radius: 8px; /* Membulatkan sudut */
        }
        .btn-primary {
            transition: background-color 0.3s, transform 0.3s; /* Menambahkan transisi */
        }
        .btn-primary:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }
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
            justify-content: space-around;
        }
        .card {
            width: 60px; /* Ukuran kartu yang lebih besar */
            height: 60px; /* Ukuran kartu yang lebih besar */
            font-size: 20px; /* Ukuran font lebih besar */
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
                    <div class="text-center mt-4">
                        <button id="remove-answer-button" class="btn-primary py-2 text-white rounded-lg">Remove Answer</button>
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
            @if($questionIndex == $totalQuestions || $questionIndex == $totalQuestions - 1)
                <button id="finish-button" class="btn-primary w-full py-2 text-white rounded-lg">Finish Attempt</button>
            @endif
        </div>
    </div>
    <div id="scroll-buttons" class="fixed bottom-20 right-20 z-50 flex flex-col items-center space-y-2">
        <button id="back-button" class="bg-gray-500 text-white rounded-full w-12 h-12 shadow-md">Back</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const totalQuestions = {{ $totalQuestions }};
            const questionIndex = {{ $questionIndex }};
            const form = document.getElementById('quiz-form');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const removeAnswerButton = document.getElementById('remove-answer-button');
            const backButton = document.getElementById('back-button');
            const finishButton = document.getElementById('finish-button');

            // Function to navigate back to quiz
            backButton.addEventListener('click', () => {
                window.location.href = '{{ url('/quiz') }}';
            });

            const populateAnswers = () => {
                const savedAnswers = JSON.parse(localStorage.getItem('quizAnswers')) || {};
                const selectedAnswer = savedAnswers[questionIndex];

                if (selectedAnswer) {
                    const radioButtons = form.querySelectorAll('input[name="answer"]');
                    radioButtons.forEach(radio => {
                        if (radio.value === selectedAnswer) {
                            radio.checked = true; // Set the radio button as checked
                        }
                    });
                }
            };

            // Call the function to populate answers
            populateAnswers();

            // Function to finish the quiz attempt
            const finishQuizAttempt = async () => {
            const url = '{{ route('grammar.quiz.finishAttempt', ['course' => $course->slug]) }}';
            const answers = JSON.parse(localStorage.getItem('quizAnswers')) || {};
            console.log('Stored answers:', answers);
            const payload = { answers }; // Menggunakan answers secara langsung

            console.log('Payload to send:', payload); // Debugging

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                const data = await response.json();
                if (data.status === 'success') {
                    localStorage.removeItem('quizAnswers');
                    window.location.href = '{{ route('grammar.quiz.completeQuiz', ['course' => $course->slug]) }}';
                } else {
                    alert('Gagal mengakhiri attempt. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Error finishing quiz attempt:', error); // Debugging
                alert('Gagal mengakhiri attempt. Silakan coba lagi.');
            }
        };

        // Event listener for finishing the quiz
        if (finishButton) {
            finishButton.addEventListener('click', (event) => {
                event.preventDefault();
                finishQuizAttempt();
            });
        }

            // Load answered cards
            const loadAnsweredCards = () => {
                const savedAnswers = JSON.parse(localStorage.getItem('quizAnswers')) || {};
                for (const index in savedAnswers) {
                    const card = document.querySelector(`.card-container a:nth-child(${parseInt(index)})`);
                    if (card) {
                        card.classList.add('answered');
                    }
                }
            };

            // Sync answers to the server
            const syncAnswersToServer = async (questionIndex) => {
                const savedAnswers = JSON.parse(localStorage.getItem('quizAnswers')) || {};
                const answer = savedAnswers[questionIndex];

                if (answer) {
                    const url = '{{ route('grammar.quiz.saveAnswer', ['course' => $course->slug, 'questionIndex' => '__questionIndex__']) }}'.replace('__questionIndex__', questionIndex);
                    const formData = new FormData();
                    formData.append('answer', answer);

                    console.log(`Sending answer for question ${questionIndex} to ${url}`);

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        console.log('Response:', response);
                        const data = await response.json();
                        console.log('Data:', data);

                        if (response.ok && data.status === 'success') {
                            const card = document.querySelector(`.card-container a:nth-child(${questionIndex})`);
                            if (card) {
                                card.classList.add('answered');
                            }
                        } else {
                            console.error('Error saving answer:', data);
                            alert('Gagal menyimpan jawaban: ' + (data.message || 'Silakan coba lagi.'));
                        }
                    } catch (error) {
                        console.error('Network error:', error);
                        alert('Jawaban belum tersimpan ke server, akan diulang ketika koneksi kembali.');
                    }
                }
            };
            const saveAnswerToLocal = (questionIndex, answer) => {
                const savedAnswers = JSON.parse(localStorage.getItem('quizAnswers')) || {};
                savedAnswers[questionIndex] = answer;
                localStorage.setItem('quizAnswers', JSON.stringify(savedAnswers));
            };
            // Event listener untuk form change
            form.addEventListener('change', () => {
                const selectedAnswer = new FormData(form).get('answer');
                if (selectedAnswer) {
                    // Simpan jawaban ke localStorage
                    saveAnswerToLocal(questionIndex, selectedAnswer);
                    // Sinkronkan hanya untuk soal yang sedang diubah
                    syncAnswersToServer(questionIndex);
                }
            });

            // Event listener for removing answer
            removeAnswerButton.addEventListener('click', async (event) => {
                event.preventDefault();
                const url = '{{ route('grammar.quiz.removeAnswer', ['course' => $course->slug, 'questionIndex' => '__questionIndex__']) }}'.replace('__questionIndex__', questionIndex);
                try {
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    });
                    const data = await response.json();
                    if (data.status === 'success') {
                        removeAnswerFromLocal(questionIndex);
                        const card = document.querySelector(`.card-container a:nth-child(${questionIndex})`);
                        if (card) {
                            card.classList.remove('answered');
                        }
                        form.reset(); // Reset the form to clear selected answers
                    } else {
                        console.error('Error removing answer:', data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal menghapus jawaban dari server. Coba lagi nanti.');
                }
            });

            // Load answered cards on page load
            loadAnsweredCards();
        });
    </script>
</body>
</html>
