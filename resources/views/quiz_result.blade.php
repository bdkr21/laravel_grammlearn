{{-- quiz_result.blade --}}
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
            <h1>{{ ucfirst($course->title) }} Quiz Result</h1>
            <p>You answered {{ $score }} out of {{ $totalQuestions }} questions correctly!</p>
            <p>You have earned {{ $pointsEarned }} points.</p>
        </div>
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($questions as $index => $question)
                        <li class="list-group-item">
                            <strong>Question {{ $index + 1 }}:</strong> {{ $question->question }}<br>
                            <strong>Your Answer:</strong> {{ $answers[$index] ?? 'N/A' }}<br>
                            <strong>Correct Answer:</strong> {{ $question->correct_answer }}<br>
                            <strong>Result:</strong> {{ $messages[$index] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
