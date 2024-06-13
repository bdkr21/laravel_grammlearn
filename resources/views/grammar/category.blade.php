<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($category) }} Questions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>{{ ucfirst($category) }} Questions</h1>
        </div>
        <div class="card-container">
            @foreach ($questions as $question)
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title">Question:</h5>
                        <p class="card-text">{{ $question['question'] }}</p>
                        <h5 class="card-title">Answer:</h5>
                        <p class="card-text">{{ $question['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
