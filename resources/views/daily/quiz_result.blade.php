<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Mission Quiz Result</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>Daily Mission Quiz Result</h1>
            <p>Your Score: {{ $score }} / {{ $totalQuestions }}</p>
        </div>
        <div>
            <h3>Questions and Corrections:</h3>
            <ul>
                @foreach ($questions as $index => $question)
                    <li>
                        <p><strong>Original Question:</strong> {{ $question->question }}</p>
                        <p><strong>Corrected Question:</strong> {{ $correctedQuestions[$index] }}</p>
                        <p><strong>Your Answer:</strong> {{ $answers[$index] ?? 'Not answered' }}</p>
                        <p><strong>Correct Answer:</strong> {{ $grammarResults[$index] ?? 'Not available' }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="text-center my-4">
            <a href="{{ route('daily.quiz.start') }}" class="btn btn-primary" aria-label="Try Again">Try Again</a>
            <a href="{{ route('quiz') }}" class="btn btn-secondary" aria-label="Home">Home</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        Swal.fire({
            position: 'center',
            title: 'Congratulations!',
            text: 'You earned {{ $score }} points in this daily mission quiz.',
            showConfirmButton: false,
            timer: 2500
        });
    </script>
</body>
</html>
