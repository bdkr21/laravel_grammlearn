<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kuiz Misi Harian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Gaya kustom */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px;
            width: 100%;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .result-header {
            font-size: 2.5rem;
            font-weight: 600;
            margin-top: 20px;
        }

        .score {
            font-size: 3rem;
            font-weight: bold;
            color: #28a745; /* Hijau untuk jawaban benar */
        }

        .question-card {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .question-card h5 {
            font-size: 1.25rem;
            font-weight: 500;
        }

        .answer-feedback {
            font-size: 1rem;
            font-weight: 400;
            margin-top: 10px;
        }

        .btn-primary, .btn-secondary {
            font-size: 1.2rem;
            padding: 12px 25px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: #0056b3;
        }

        .correct {
            color: green;
        }

        .incorrect {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1 class="result-header">Hasil Kuiz Misi Harian</h1>
            <p class="score">Poin Anda: {{ $score }} </p>
        </div>

        <div>
            <div class="list-group">
                @foreach ($questions as $index => $question)
                    <div class="question-card">
                        <h5><strong>Kalimat yang perlu diperbaiki:</strong> {{ $question->question }}</h5>
                        <p><strong>Jawaban Anda:</strong> {{ $answers[$index] ?? 'Tidak dijawab' }}</p>
                        <p><strong>Jawaban Benar:</strong> {{ $correctedQuestions[$index] }}</p>
                        <p class="answer-feedback">
                            @if ($answers[$index] === $correctedQuestions[$index])
                                <span class="correct">✔ Benar!</span>
                            @else
                                <span class="incorrect">❌ Salah</span>
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-center my-4">
            {{-- <a href="{{ route('daily.quiz.start') }}" class="btn btn-primary" aria-label="Coba Lagi">Coba Lagi</a> --}}
            <a href="{{ route('quiz') }}" class="btn btn-secondary" aria-label="Beranda">Beranda</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        Swal.fire({
            position: 'center',
            title: 'Selamat!',
            text: 'Anda mendapatkan {{ $score }} poin pada kuiz misi harian ini.',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
</body>
</html>
