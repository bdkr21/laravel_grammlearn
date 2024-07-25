<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basics Test</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="font-sans bg-gray-100">

    @include('components.navbar')

    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-5 text-center">Kuis</h1>
        <ul class="flex justify-center space-x-4 mb-5 border-b">
            <li class="pb-2 border-b-2 border-blue-500"><a href="#" class="text-blue-500">All</a></li>
        </ul>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($courses as $course)
                @php
                    $pointsRequired = $course->required_points;
                @endphp

                <div class="bg-white shadow-md rounded-lg overflow-hidden transform transition-transform hover:scale-105">
                    <div class="p-6">
                        <h5 class="text-xl font-semibold mb-2">{{ $course->title }}</h5>
                        <p class="text-gray-700 mb-4">{{ $course->description }}</p>
                        <div class="flex justify-center mt-4">
                            @auth
                                <button onclick="confirmAccess('{{ route('grammar.quiz.start', $course->slug) }}')"class="bg-yellow-600 text-white px-4 py-2 rounded-full shadow hover:bg-yellow-800 transition-colors">
                                    Ikuti Kuis
                                </button>
                            @else
                            <button onclick="promptLoginOrSignUp()" class="bg-yellow-600 text-white px-4 py-2 rounded-full shadow hover:bg-yellow-800 transition-colors">
                                Ikuti Kuis
                            </button>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @vite('resources/js/app.js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        function confirmAccess(url) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Apakah Anda ingin mengikuti kuis ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ikuti!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
        function promptLoginOrSignUp() {
            Swal.fire({
                title: 'Not logged in',
                text: "You need to log in or sign up to access this course.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login',
                cancelButtonText: 'Sign Up'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('login') }}';
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '{{ route('register') }}';
                }
            })
        }
    </script>

</body>
</html>
