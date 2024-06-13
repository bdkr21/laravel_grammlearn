<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Open Category</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="text-center my-4">
            <h1>Confirm Opening Category</h1>
            <p>You are about to open the category "{{ $category->title }}" which requires {{ $pointsRequired }} points.</p>
            <p>Your current points: {{ Auth::user()->points }}</p>
        </div>
        <div class="text-center">
            <a href="{{ route('grammar.quiz.confirmOpen', ['category' => $category->slug]) }}" class="btn btn-primary">Confirm</a>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
