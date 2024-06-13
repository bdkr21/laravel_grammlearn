<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($category->title) }} Quiz Result</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>{{ ucfirst($category->title) }} Quiz Result</h1>
            <p>Your Score:</p>
            <p>You scored {{ $score }} out of {{ $totalQuestions }}.</p>
            <p>You earned: {{ $points }} points</p>
        </div>
        @php
            $wrongAnswers = [];
            foreach ($questions as $index => $question) {
                if (isset($answers[$index]) && strtolower($answers[$index]) != strtolower($question->answer)) {
                    $wrongAnswers[] = $question;
                }
            }
        @endphp
        @if (count($wrongAnswers) > 0)
            <div>
                <h3>Questions You Got Wrong:</h3>
                <ul>
                    @foreach ($wrongAnswers as $index => $question)
                        <li>
                            <p>{{ $question->question }}</p>
                            <p><strong>Correct Answer:</strong> {{ $question->answer }}</p>
                            <p><strong>Your Answer:</strong> {{ $answers[$index] ?? 'Not answered' }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-center my-4">
            <a href="{{ route('grammar.quiz', ['category' => strtolower($category->slug)]) }}" class="btn btn-primary" aria-label="Try Again">Try Again</a>
            <a href="{{ route('home') }}" class="btn btn-secondary" aria-label="Home">Home</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
