{{-- quiz.blade --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($course->title) }} Quiz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>{{ ucfirst($course->title) }} Quiz</h1>
            <p>Question {{ $currentQuestionIndex }} of {{ $totalQuestions }}</p>
            <p>Perbaiki soal Grammar dibawah ini:</p>
        </div>
        <form action="{{ route('grammar.quiz.submitAnswer', ['course' => $course->slug, 'questionIndex' => $currentQuestionIndex]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question">{{ $question->question }}</label>
                <input type="text" name="answer" class="form-control" id="answer" value="{{ old('answer') }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit Answer</button>
                @if ($currentQuestionIndex > 1)
                    <a href="{{ route('grammar.quiz.previousQuestion', ['course' => $course->slug, 'questionIndex' => $currentQuestionIndex]) }}" class="btn btn-secondary">Previous</a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>
