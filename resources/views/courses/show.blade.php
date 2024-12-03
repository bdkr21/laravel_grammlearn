<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <style>
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .nav-link {
            color: #fff !important;
            padding: 0.5rem 1rem;
        }
        .dropdown-menu {
            background-color: #343a40;
        }
        .dropdown-item {
            color: #fff !important;
        }
        .dropdown-item:hover {
            background-color: #495057;
        }
        .dropdown-divider {
            border-color: #495057;
        }
        .card {
            margin-top: 20px;
        }
        .circular-progress-container {
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background: conic-gradient(#28a745 var(--progress, 0%), #e0e0e0 0%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .circular-progress-text {
            font-size: 12px;
            color: #fff;
        }
        #scroll-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s;
        }
        #scroll-buttons.visible {
            opacity: 1;
        }
        #back-button, #to-top-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    @include('components.navbar')

    <!-- Circular Progress Bar Container -->
    <div class="circular-progress-container" id="circular-progress">
        <span class="circular-progress-text" id="progress-text">0%</span>
    </div>

    <!-- Scroll Buttons -->
    <div id="scroll-buttons" class="fixed bottom-20 right-20 z-50 flex flex-col items-center space-y-2">
        <button id="back-button" class="bg-gray-500 text-white rounded-full w-12 h-12 shadow-md">Back</button>
        <button id="to-top-button" class="bg-blue-500 text-white rounded-full w-12 h-12 shadow-md">To Top</button>
    </div>

    <div class="container mx-auto p-5">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">{{ $course->title }}</h1>
            <div class="content">
                {!! $course->content !!} <!-- Render konten langsung -->
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function initializeProgressBar() {
            console.log("DOM fully loaded and parsed");
            let startTime = Date.now();
            console.log("Start time: ", startTime);

            let circularProgress = document.getElementById('circular-progress');
            let progressText = document.getElementById('progress-text');
            let totalTime = 3; // Total time in seconds (5 minutes)

            let interval = setInterval(() => {
                let currentTime = Date.now();
                let elapsedTime = (currentTime - startTime) / 1000;
                let percentage = (elapsedTime / totalTime) * 100;

                if (percentage >= 100) {
                    percentage = 100;
                    clearInterval(interval);
                    @auth
                        givePointsToUser();
                    @else
                        console.log("User is not logged in, no points will be awarded.");
                    @endauth
                }

                circularProgress.style.setProperty('--progress', percentage + '%');
                progressText.textContent = Math.round(percentage) + '%';
            }, 1000);
        }

        function givePointsToUser() {
            fetch('/api/give-points', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ course_id: '{{ $course->id }}' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success("Selamat mendapatkan poin!");
                } else {
                    toastr.error("There was an error awarding points.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', initializeProgressBar);

        document.addEventListener('DOMContentLoaded', () => {
            const backButton = document.getElementById('back-button');
            const toTopButton = document.getElementById('to-top-button');
            const scrollButtons = document.getElementById('scroll-buttons');
            let previousScrollPosition = 0;

            backButton.addEventListener('click', () => {
                window.history.back();
            });

            toTopButton.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            window.addEventListener('scroll', () => {
                const currentScrollPosition = window.pageYOffset;

                if (currentScrollPosition > 0) {
                    scrollButtons.classList.add('visible');
                } else {
                    scrollButtons.classList.remove('visible');
                }

                previousScrollPosition = currentScrollPosition;
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>
