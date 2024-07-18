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
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    @include('components.navbar')

    <!-- Circular Progress Bar Container -->
    <div class="circular-progress-container" id="circular-progress">
        <span class="circular-progress-text" id="progress-text">0%</span>
    </div>

    <div class="container mx-auto p-5">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $course->title }}</h2>
            </div>
            <div class="card-body">
                <h5>Parts of Speech</h5>
                <p>Parts of speech adalah kategori kata berdasarkan fungsi dan penggunaannya dalam kalimat. Berikut adalah beberapa jenis parts of speech beserta contohnya:</p>
                <ul>
                    <li><strong>Noun (Kata Benda):</strong> Kata yang digunakan untuk menyebutkan orang, tempat, benda, atau konsep. Contoh: <em>dog</em>, <em>school</em>, <em>happiness</em>.</li>
                    <li><strong>Pronoun (Kata Ganti):</strong> Kata yang digunakan untuk menggantikan noun. Contoh: <em>he</em>, <em>they</em>, <em>it</em>.</li>
                    <li><strong>Adjective (Kata Sifat):</strong> Kata yang digunakan untuk mendeskripsikan noun atau pronoun. Contoh: <em>beautiful</em>, <em>quick</em>, <em>happy</em>.</li>
                    <li><strong>Verb (Kata Kerja):</strong> Kata yang menggambarkan tindakan atau keadaan. Contoh: <em>run</em>, <em>is</em>, <em>have</em>.</li>
                    <li><strong>Adverb (Kata Keterangan):</strong> Kata yang mendeskripsikan verb, adjective, atau adverb lain. Contoh: <em>quickly</em>, <em>very</em>, <em>well</em>.</li>
                    <li><strong>Preposition (Kata Depan):</strong> Kata yang menunjukkan hubungan antara noun atau pronoun dengan kata lain dalam kalimat. Contoh: <em>in</em>, <em>on</em>, <em>at</em>.</li>
                    <li><strong>Conjunction (Kata Penghubung):</strong> Kata yang menghubungkan kata, frasa, atau klausa. Contoh: <em>and</em>, <em>but</em>, <em>or</em>.</li>
                    <li><strong>Interjection (Kata Seru):</strong> Kata yang digunakan untuk mengekspresikan emosi. Contoh: <em>oh</em>, <em>wow</em>, <em>ouch</em>.</li>
                </ul>
                <p>Dengan memahami parts of speech, Anda dapat membuat kalimat yang lebih jelas dan efektif dalam bahasa Inggris.</p>
            </div>
        </div>
    </div>

    @vite('resources/js/app.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
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
        });

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
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>
