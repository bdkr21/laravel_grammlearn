<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Grammlearn</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .about-section {
            padding: 60px 20px;
            background-color: #ffffff;
        }
        .about-section h1 {
            font-size: 3rem;
            color: #0062E6;
            text-align: center;
            margin-bottom: 20px;
        }
        .about-section p {
            font-size: 1.25rem;
            color: #333;
            text-align: justify;
            line-height: 1.8;
        }
        .about-section .highlight {
            color: #0062E6;
            font-weight: bold;
        }
        .values-section {
            background-color: #f8f9fa;
            padding: 40px 20px;
            text-align: center;
        }
        .value {
            margin-bottom: 30px;
        }
        .value h3 {
            font-size: 1.5rem;
            color: #0062E6;
            margin-bottom: 10px;
        }
        .value p {
            font-size: 1.125rem;
            color: #666;
        }
        footer {
            background-color: #0062E6;
            color: white;
            text-align: center;
            padding: 20px 0;
        }
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    @include('components.navbar')

    <!-- About Section -->
    <section class="about-section">
        <div class="container mx-auto">
            <h1>Tentang Grammlearn</h1>
            <p>
                Grammlearn adalah platform <span class="highlight">Learning Management System</span> yang dirancang untuk membantu pengguna meningkatkan kemampuan grammar bahasa Inggris mereka melalui kuis interaktif dan fitur-fitur menarik lainnya. Kami percaya bahwa pembelajaran yang menyenangkan dan terstruktur dapat memberikan hasil yang maksimal bagi setiap pengguna.
            </p>
            <p>
                Dengan <span class="highlight">Grammlearn</span>, Anda dapat mengakses berbagai kategori latihan grammar, mendapatkan tantangan harian, dan melacak perkembangan Anda. Kami berkomitmen untuk menyediakan pengalaman belajar yang inovatif, mudah diakses, dan mendukung setiap langkah perjalanan belajar Anda.
            </p>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-8">Nilai-Nilai Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="value">
                    <h3>Pendidikan untuk Semua</h3>
                    <p>Kami percaya bahwa setiap orang berhak mendapatkan akses ke pendidikan berkualitas tanpa hambatan.</p>
                </div>
                <div class="value">
                    <h3>Interaktif dan Menyenangkan</h3>
                    <p>Proses belajar haruslah menyenangkan dan memberikan motivasi kepada pengguna untuk terus berkembang.</p>
                </div>
                <div class="value">
                    <h3>Inovasi Berkelanjutan</h3>
                    <p>Kami terus berinovasi untuk menyediakan fitur dan pengalaman terbaik bagi pengguna kami.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container mx-auto">
            <p>&copy; 2024 Grammlearn. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
