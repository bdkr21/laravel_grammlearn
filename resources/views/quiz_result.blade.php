<!-- quiz_result.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>{{ ucfirst($category->title) }} Quiz Result</h1>
            <p>Your Score: {{ $score }} / {{ $totalQuestions }}</p>
            {{-- <p>You earned {{ $points }} points</p> --}}
        </div>
        <div class="my-4">
            @foreach($questions as $index => $question)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Question {{ $index + 1 }}</h5>
                        <p class="card-text">{{ $question->question }}</p>
                        <p>Your Answer: {{ isset($answers[$index]) ? $answers[$index] : 'N/A' }}</p>
                        <p>Correct Answer: {{ isset($grammarResults[$index]) ? $grammarResults[$index] : 'N/A' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center my-4">
            <a href="{{ route('home') }}" class="btn btn-secondary" aria-label="Home">Home</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
