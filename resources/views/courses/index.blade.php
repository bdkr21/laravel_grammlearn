<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Grammar Bahasa Inggris</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg max-w-5xl">
        <h1 class="text-center text-3xl font-bold text-gray-800 mb-10">Materi Grammar Bahasa Inggris</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($grammarTopics as $section => $topics)
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold text-blue-600 mb-4">{{ $section }}</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($topics as $topic)
                            <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-200">
                                <a href="javascript:void(0)" onclick="loadTopicDetail('{{ strtolower($topic['title']) }}')" class="block text-blue-500 font-bold hover:underline">
                                    <h3 class="text-lg">{{ $topic['title'] }}</h3>
                                </a>
                                <p class="text-gray-600 mt-2">{{ $topic['description_preview'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <h3 class="text-xl mt-10"><a href="{{ route('quiz') }}" class="text-blue-500 hover:underline">Quiz</a></h3>
    </div>

    <!-- Modal -->
    <div id="topicModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg max-w-xl mx-auto">
            <div class="p-4 border-b">
                <h5 class="text-2xl font-bold" id="topic-title"></h5>
                <button class="text-gray-500 hover:text-gray-700 float-right" onclick="closeModal()">×</button>
            </div>
            <div class="p-4">
                <p id="topic-description"></p>
            </div>
            <div class="p-4 border-t text-right">
                <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script>
        function loadTopicDetail(topic) {
            fetch('/materi/' + topic)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    document.getElementById('topic-title').textContent = data.title;
                    document.getElementById('topic-description').textContent = data.description;
                    document.getElementById('topicModal').classList.remove('hidden');
                    document.getElementById('topicModal').classList.add('flex');
                })
                .catch(() => {
                    alert('Topic not found');
                });
        }

        function closeModal() {
            document.getElementById('topicModal').classList.add('hidden');
            document.getElementById('topicModal').classList.remove('flex');
        }
    </script>
</body>
</html>
