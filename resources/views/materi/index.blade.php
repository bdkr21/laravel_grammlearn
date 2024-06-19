<!DOCTYPE html>
<html>
<head>
    <title>Materi</title>
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
        }
        .grid-container {
            margin-left: 250px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .grammar-section {
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
        }
        .grammar-section h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .grammar-section ul {
            list-style-type: none;
            padding: 0;
        }
        .grammar-section ul li {
            margin-bottom: 5px;
        }
        .grammar-section ul li a {
            text-decoration: none;
            color: #007BFF;
        }
        .grammar-section ul li a:hover {
            text-decoration: underline;
        }
        .topic-detail {
            display: none;
            margin-top: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentTopic = '';

        function loadTopicDetail(topic) {
            if (currentTopic === topic) {
                $('.topic-detail').slideUp();
                currentTopic = '';
                return;
            }

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
                    $('.topic-detail').slideDown();
                    currentTopic = topic;
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
        <h1>English Grammar</h1>
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
        <h3><a href="{{ route('home') }}">Back</a></h3>
        <div class="topic-detail">
            <h2 id="topic-title"></h2>
            <p id="topic-description"></p>
        </div>
    </div>
</body>
</html>
