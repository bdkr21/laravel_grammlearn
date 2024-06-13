
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($category) }} Grammar Questions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>{{ ucfirst($category) }} Grammar Questions</h1>
            <p>Question {{ $questionNumber }} of {{ $totalQuestions }}</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $question['question'] }}</h5>
                <form method="POST" action="{{ route('grammar.submit', ['category' => $category, 'questionNumber' => $questionNumber]) }}">
                    @csrf
                    @foreach ($question['options'] as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answer" id="option_{{ $loop->index }}" value="{{ $option }}" required>
                            <label class="form-check-label" for="option_{{ $loop->index }}">
                                {{ $option }}
                            </label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>

        <div class="progress mt-4">
            <div class="progress-bar" role="progressbar" style="width: {{ ($questionNumber / $totalQuestions) * 100 }}%;" aria-valuenow="{{ ($questionNumber / $totalQuestions) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
