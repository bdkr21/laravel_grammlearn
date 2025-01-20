<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grammlearn Learning Management System</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(to right, #0062E6, #33AEFF);
            color: white;
            padding: 60px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section h1 {
            font-size: 3rem;
            animation: fadeInDown 1s ease-out;
        }
        .hero-section p {
            font-size: 1.5rem;
            animation: fadeInUp 1s ease-out;
        }
        .hero-section .cta-btn {
            background-color: #ffcc00;
            color: #0062E6;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .hero-section .cta-btn:hover {
            background-color: #ff9900;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .features-section {
            padding: 40px 0;
            background-color: #ffffff;
            text-align: center;
        }
        .feature {
            margin-bottom: 30px;
            animation: fadeIn 1s ease;
        }
        .feature h3 {
            font-size: 1.5rem;
            color: #0062E6;
        }
        .feature p {
            font-size: 1.125rem;
            color: #666;
        }
        .feature img {
            max-width: 100px;
            margin-bottom: 20px;
        }
        .cta-section {
            background: linear-gradient(to right, #0062E6, #33AEFF);
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .cta-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .cta-section p {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }
        .cta-section .cta-btn {
            background-color: #ffcc00;
            color: #0062E6;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .cta-section .cta-btn:hover {
            background-color: #ff9900;
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
<body class="bg-gray-100">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container mx-auto py-16">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang di Grammlearn</h1>
            <p class="text-xl mb-8">Tingkatkan kemampuan grammar bahasa Inggris Anda dengan kuis interaktif dan menyenangkan!</p>
            <a href="{{ route('index.courses') }}" class="cta-btn">Mulai Sekarang</a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature">
                    <h3 class="text-xl font-semibold mb-2">Misi Harian</h3>
                    <p class="text-gray-600">Tantang diri Anda dengan pertanyaan grammar bahasa Inggris baru setiap hari dan dapatkan poin tambahan.</p>
                </div>
                <div class="feature">
                    <h3 class="text-xl font-semibold mb-2">Kuis Kategori</h3>
                    <p class="text-gray-600">Uji keterampilan Anda dalam berbagai kategori grammar dan lacak kemajuan Anda.</p>
                </div>
                <div class="feature">
                    <h3 class="text-xl font-semibold mb-2">Perolehan Poin</h3>
                    <p class="text-gray-600">Dapatkan poin saat Anda meningkatkan kemampuan grammar Anda.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Kami Sekarang!</h2>
            <p class="text-xl mb-8">Mulailah perjalanan Anda untuk meningkatkan kemampuan grammar bahasa Inggris dengan Grammar Quiz. Gratis dan mudah digunakan.</p>
            <a href="{{ route('register') }}" class="cta-btn">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container mx-auto">
            <p>&copy; 2024 Grammlearn. All rights reserved. <a href="{{ route('about') }}" class="cta-btn">Tentang Kami</a>
            </p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
