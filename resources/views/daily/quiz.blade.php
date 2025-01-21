<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Mission Quiz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background-color: #f4f6f9;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Make sure the body takes the full height of the viewport */
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin-top: 40px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .question-header {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
        .question-number {
            font-size: 1rem;
            color: #666;
        }
        .question-text {
            font-size: 1.25rem;
            margin-bottom: 20px;
            color: #333;
        }
        .form-control {
            font-size: 1.1rem;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .btn {
            font-size: 1.1rem;
            padding: 12px;
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #4CAF50;
            border: none;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        .btn-secondary {
            background-color: #e0e0e0;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #d4d4d4;
        }
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
        }
        .home-btn {
            width: 100%;
            margin-top: 30px;
        }
        .progress-container {
            margin: 20px 0;
        }
        .progress-bar {
            height: 8px;
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tampilkan pesan jika ada session('message') -->
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <div class="card">
            <div class="question-text">
                <p>Perbaiki soal Grammar di bawah ini:</p>
                <p><strong>{{ $question->question }}</strong></p>
            </div>

            <form action="{{ route('daily.quiz.submitAnswer', ['questionIndex' => $currentQuestionIndex]) }}" method="POST">
                @csrf
                <input type="text" name="answer" class="form-control" placeholder="Masukkan jawaban" required>

                <input type="hidden" name="currentQuestionIndex" value="{{ $currentQuestionIndex }}">

                <div class="navigation-buttons">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

            <a href="{{ route('quiz') }}" class="btn btn-secondary home-btn">Home</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
