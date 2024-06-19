<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Mission Quiz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>Daily Mission Quiz</h1>
            <p>Question {{ $currentQuestionIndex }} of {{ $totalQuestions }}</p>
            <p>Perbaiki soal Grammar dibawah ini:</p>
        </div>
        <form action="{{ route('daily.quiz.submitAnswer', ['questionIndex' => $currentQuestionIndex]) }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="text-center"><label>{{ $question->question }}</label></div>
                <input type="text" name="answer" class="form-control" required>
            </div>
            <input type="hidden" name="currentQuestionIndex" value="{{ $currentQuestionIndex }}">
            <br>
            @if ($currentQuestionIndex < $totalQuestions)
                <button type="submit" class="btn btn-primary">Next</button>
            @else
                <button type="submit" class="btn btn-success">Submit</button>
            @endif
        </form>
        @if ($currentQuestionIndex > 1)
            <form action="{{ route('daily.quiz.showQuestion', ['questionIndex' => $currentQuestionIndex - 1]) }}" method="GET" style="display: inline;">
                <button type="submit" class="btn btn-secondary" aria-label="Previous">Previous</button>
            </form>
        @endif
        <div class="text-center my-4">
            <a href="{{ route('quiz') }}" class="btn btn-secondary" aria-label="Home">Home</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
