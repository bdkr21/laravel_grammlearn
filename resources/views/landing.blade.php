<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grammlearn Learning Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            background-color: #007bff;
            color: white;
            padding: 60px 0;
        }
        .hero-section h1 {
            font-size: 3rem;
        }
        .hero-section p {
            font-size: 1.5rem;
        }
        .features-section {
            padding: 40px 0;
        }
        .feature {
            margin-bottom: 30px;
        }
        .feature h3 {
            font-size: 1.25rem;
        }
        .feature p {
            font-size: 1rem;
        }
        .about-section {
            background-color: #ffffff;
            padding: 40px 0;
        }
        .about-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .testimonial-section {
            background-color: #f1f1f1;
            padding: 40px 0;
        }
        .testimonial {
            margin-bottom: 30px;
        }
        .testimonial p {
            font-size: 1rem;
        }
        .cta-section {
            background-color: #007bff;
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
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Hero Section -->
    <header class="hero-section bg-blue-500 text-white text-center">
        <div class="container mx-auto py-16">
            <h1 class="text-5xl font-bold mb-4">Selamat Datang di Grammlearn</h1>
            <p class="text-xl mb-8">Tingkatkan kemampuan grammar bahasa Inggris Anda dengan kuis interaktif dan menyenangkan!</p>
            <a href="{{ route('index.courses') }}" class="bg-white text-blue-500 font-semibold px-6 py-3 rounded">Mulai Sekarang</a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features-section text-center py-16">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="feature">
                    <h3 class="text-xl font-semibold mb-2">Misi Harian</h3>
                    <p class="text-gray-600">Tantang diri Anda dengan pertanyaan grammar bahasa Inggris baru setiap hari.</p>
                </div>
                <div class="feature">
                    <h3 class="text-xl font-semibold mb-2">Kuis Kategori</h3>
                    <p class="text-gray-600">Uji keterampilan Anda dalam berbagai kategori grammar dan lacak kemajuan Anda.</p>
                </div>
                <div class="feature">
                    <h3 class="text-xl font-semibold mb-2">Peroleh Poin</h3>
                    <p class="text-gray-600">Buka kategori baru dan dapatkan poin saat Anda meningkatkan kemampuan grammar Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section bg-blue-500 text-white text-center py-16">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold mb-4">Bergabunglah dengan Kami Sekarang!</h2>
            <p class="text-xl mb-8">Mulailah perjalanan Anda untuk meningkatkan kemampuan grammar bahasa Inggris dengan Grammar Quiz. Gratis dan mudah digunakan.</p>
            <a href="{{ route('register') }}" class="bg-white text-blue-500 font-semibold px-6 py-3 rounded">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-4">
        <div class="container mx-auto">
            <p class="text-gray-700">&copy; 2024 Grammlearn.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
