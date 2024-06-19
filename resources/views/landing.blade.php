<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Grammar Quiz Bahasa Inggris</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
<body>
    <header class="hero-section text-center">
        <div class="container">
            <h1>Selamat Datang di Grammlearn</h1>
            <p>Tingkatkan kemampuan grammar bahasa Inggris Anda dengan kuis interaktif dan menyenangkan!</p>
            <a href="{{ route('home') }}" class="btn btn-light btn-lg">Mulai Sekarang</a>
        </div>
    </header>

    <section class="features-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 feature">
                    <h3>Misi Harian</h3>
                    <p>Tantang diri Anda dengan pertanyaan grammar bahasa Inggris baru setiap hari.</p>
                </div>
                <div class="col-md-4 feature">
                    <h3>Kuis Kategori</h3>
                    <p>Uji keterampilan Anda dalam berbagai kategori grammar dan lacak kemajuan Anda.</p>
                </div>
                <div class="col-md-4 feature">
                    <h3>Peroleh Poin</h3>
                    <p>Buka kategori baru dan dapatkan poin saat Anda meningkatkan kemampuan grammar Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="about-section text-center">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>Grammar Quiz Bahasa Inggris adalah platform edukatif yang dirancang untuk membantu Anda meningkatkan keterampilan grammar bahasa Inggris melalui latihan yang interaktif dan menyenangkan. Kami percaya bahwa belajar bahasa haruslah menyenangkan dan efektif.</p>
        </div>
    </section>

    <section class="testimonial-section text-center">
        <div class="container">
            <h2>Apa Kata Mereka</h2>
            <div class="row">
                <div class="col-md-4 testimonial">
                    <p>"Grammar Quiz sangat membantu saya dalam memahami grammar bahasa Inggris dengan lebih baik. Saya merasa lebih percaya diri dalam menulis bahasa Inggris." - <strong>Siti</strong></p>
                </div>
                <div class="col-md-4 testimonial">
                    <p>"Platform ini menyenangkan dan interaktif. Saya bisa belajar sambil bermain kuis." - <strong>Budi</strong></p>
                </div>
                <div class="col-md-4 testimonial">
                    <p>"Misi harian membuat saya selalu termotivasi untuk belajar setiap hari. Terima kasih, Grammar Quiz!" - <strong>Andi</strong></p>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="cta-section">
        <div class="container">
            <h2>Bergabunglah dengan Kami Sekarang!</h2>
            <p>Mulailah perjalanan Anda untuk meningkatkan kemampuan grammar bahasa Inggris dengan Grammar Quiz. Gratis dan mudah digunakan.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">Daftar Sekarang</a>
        </div>
    </section>

    <footer class="text-center py-4">
        <div class="container">
            <p>&copy; 2024 Grammlearn.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
