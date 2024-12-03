{{-- courses\index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    @include('components.navbar')

    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-5 text-center">Course Overview</h1>
        <ul class="flex justify-center space-x-4 mb-5 border-b">
            <li class="pb-2 border-b-2 border-blue-500"><a href="#" class="text-blue-500">All</a></li>
        </ul>
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($grammarTopics as $category => $courses)
                    @foreach($courses as $course)
                        @if(isset($course->title))
                        <div class="bg-white p-6 rounded-lg shadow-lg transform transition-transform hover:scale-105 relative">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h5 class="text-xl font-bold mb-2"><a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a></h5>
                                    <p class="text-gray-600">{{ $course->description }}</p>
                                </div>
                            </div>
                            <div class="flex justify-center mt-4">
                                @auth
                                    @if(in_array($course->id, $userAccessLogs))
                                        <button onclick="window.location.href='{{ route('courses.show', $course->id) }}'" class="bg-green-500 text-white px-4 py-2 rounded-full shadow hover:bg-green-600 transition-colors">
                                            Lihat materi
                                        </button>
                                    @else
                                        <button onclick="confirmAccess('{{ route('courses.show', $course->id) }}')" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow hover:bg-blue-600 transition-colors">
                                            Dapatkan akses
                                        </button>
                                    @endif
                                @else
                                    <button onclick="promptLoginOrSignUp()" class="bg-blue-500 text-white px-4 py-2 rounded-full shadow hover:bg-blue-600 transition-colors">
                                        Dapatkan akses
                                    </button>
                                @endauth
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmAccess(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah Anda ingin mengakses ke kursus ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dapatkan akses'
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
