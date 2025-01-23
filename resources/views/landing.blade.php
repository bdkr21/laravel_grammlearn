<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grammlearn Learning Management System</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/wave-bsb.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        .custom-btn {
            font-size: 17px;
            padding: 0.5em 2em;
            border: transparent;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            background: dodgerblue;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .custom-btn:hover {
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(30, 144, 255, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }

        .custom-btn:active {
            transform: translate(0em, 0.2em);
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    @include('components.navbar')

    <section id="scrollspyHero" class="bsb-hero-2 bsb-tpl-bg-blue py-5 py-xl-8 py-xxl-10">
        <div class="container overflow-hidden">
          <div class="row gy-3 gy-lg-0 align-items-lg-center justify-content-lg-between">
            <div class="col-12 col-lg-6 order-1 order-lg-0">
              <h1 class="display-3 fw-bolder mb-3">Selamat Datang di Grammlearn</h1>
              <p class="fs-4 mb-5">Raih kemampuan bahasa Inggris yang lebih baik dengan pengalaman belajar yang interaktif dan menyenangkan bersama kami.</p>
              <div class="d-grid gap-2 d-sm-flex">
                <a href={{ route('index.courses') }} class="btn btn-primary bsb-btn-3xl rounded-pill">Mulai Belajar</a>
              </div>
            </div>
            <div class="col-12 col-lg-5 text-center">
              <img class="img-fluid" loading="lazy" src="{{ asset('images/robin-coode.jpg') }}">
            </div>
          </div>
        </div>
      </section>

    <!-- Features Section -->
    <main id="main">

        <!-- Section - Services -->
        <!-- Service 3 - Bootstrap Brain Component -->
        <section id="scrollspyServices" class="py-5 py-xl-8 bsb-section-py-xxl-1">
          <div class="container mb-5 mb-md-6 mb-xl-10">
            <div class="row justify-content-md-center">
              <div class="col-12 col-md-10 col-lg-9 col-xl-8 col-xxl-7 text-center">
                <h3 class="display-3 fw-bolder mb-4">Keunggulan Grammlearn</h3>
              </div>
            </div>
          </div>

          <div class="container overflow-hidden">
            <div class="row gy-5 gx-md-4 gy-lg-0 gx-xxl-5 justify-content-center">
              <div class="col-11 col-sm-6 col-lg-3">
                <div class="badge bsb-tpl-bg-yellow text-primary p-3 mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pie-chart" viewBox="0 0 16 16">
                    <path d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793V1.018zm1 0V7.5h6.482A7.001 7.001 0 0 0 8.5 1.018zM14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
                  </svg>
                </div>
                <h4 class="mb-3">Modul Interaktif</h4>
                <p class="mb-3 text-secondary">Belajar dengan cara yang lebih hidup dan menarik.</p>
                <a href="#!" class="fw-bold text-decoration-none link-primary">
                  Learn More
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                  </svg>
                </a>
              </div>
              <div class="col-11 col-sm-6 col-lg-3">
                <div class="badge bsb-tpl-bg-green text-primary p-3 mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-aspect-ratio" viewBox="0 0 16 16">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
                    <path d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0v-3zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0v3z" />
                  </svg>
                </div>
                <h4 class="mb-3">Analisis Kemajuan</h4>
                <p class="mb-3 text-secondary">Pantau perkembangan belajar Anda secara real-time.</p>
                <a href="#!" class="fw-bold text-decoration-none link-primary">
                  Learn More
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                  </svg>
                </a>
              </div>
              <div class="col-11 col-sm-6 col-lg-3">
                <div class="badge bsb-tpl-bg-pink text-primary p-3 mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-airplane-engines" viewBox="0 0 16 16">
                    <path d="M8 0c-.787 0-1.292.592-1.572 1.151A4.347 4.347 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0ZM7 3c0-.432.11-.979.322-1.401C7.542 1.159 7.787 1 8 1c.213 0 .458.158.678.599C8.889 2.02 9 2.569 9 3v4a.5.5 0 0 0 .276.447l5.448 2.724a.5.5 0 0 1 .276.447v.792l-5.418-.903a.5.5 0 0 0-.575.41l-.5 3a.5.5 0 0 0 .14.437l.646.646H6.707l.647-.646a.5.5 0 0 0 .14-.436l-.5-3a.5.5 0 0 0-.576-.411L1 11.41v-.792a.5.5 0 0 1 .276-.447l5.448-2.724A.5.5 0 0 0 7 7V3Z" />
                  </svg>
                </div>
                <h4 class="mb-3">Komunitas Belajar</h4>
                <p class="mb-3 text-secondary">Bergabunglah dengan komunitas kami untuk belajar bersama.</p>
                <a href="#!" class="fw-bold text-decoration-none link-primary">
                  Learn More
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </section>
      </main>


    <!-- Footer -->
    <footer class="footer">
        <!-- Copyright - Bootstrap Brain Component -->
        <div class="bg-light py-4 py-md-5 py-xl-8 border-top border-light-subtle">
          <div class="container overflow-hidden">
            <div class="row gy-4 gy-md-0">
              <div class="col-xs-12 col-md-7 order-1 order-md-0">
                <div class="copyright text-center text-md-start">
                    &copy; 2024 Grammlearn. All rights reserved.
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>



</body>
</html>
