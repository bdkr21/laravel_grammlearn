<!DOCTYPE html>
<html>
<head>
    <title>Materi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .grammar-section {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .grammar-section h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #007BFF;
        }
        .grammar-section ul {
            list-style-type: none;
            padding: 0;
        }
        .grammar-section ul li {
            margin-bottom: 10px;
        }
        .grammar-section ul li a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        .grammar-section ul li a:hover {
            text-decoration: underline;
        }
        .modal-content {
            font-size: 16px;
            line-height: 1.6;
        }
        .modal-title {
            font-size: 24px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function loadTopicDetail(topic) {
            $.ajax({
                url: '/materi/' + topic,
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    $('#topic-title').text(data.title);
                    $('#topic-description').text(data.description);
                    $('#topicModal').modal('show');
                },
                error: function() {
                    alert('Topic not found');
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Materi Grammar Bahasa Inggris</h1>
        <div class="grid-container">
            @foreach($grammarTopics as $section => $topics)
                <div class="grammar-section">
                    <h2>{{ $section }}</h2>
                    <ul>
                        @foreach($topics as $topic)
                            <li><a href="javascript:void(0)" onclick="loadTopicDetail('{{ strtolower($topic['title']) }}')">{{ $topic['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        <h3><a href="{{ route('quiz') }}">Quiz</a></h3>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="topicModal" tabindex="-1" role="dialog" aria-labelledby="topicModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="topic-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="topic-description"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
