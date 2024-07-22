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
                        @if (Auth::check() && Auth::user()->unlockedCourses && Auth::user()->unlockedCourses->contains($course->id))
                            <a href="{{ route('grammar.quiz.showQuestion', ['course' => $course->slug, 'questionIndex' => 1]) }}" class="inline-block px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" aria-label="Learn">Learn</a>
                        @else
                            @if (Auth::check())
                                @if (Auth::user()->points >= $pointsRequired)
                                    <button class="unlock-course-btn inline-block px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75" data-course="{{ $course->slug }}" data-points-required="{{ $pointsRequired }}" aria-label="Unlock">Unlock ({{ $pointsRequired }} points)</button>
                                @else
                                    <button class="inline-block px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md cursor-not-allowed" disabled aria-label="Locked">Locked (Requires {{ $pointsRequired }} points)</button>
                                @endif
                            @else
                                <button class="inline-block px-4 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md cursor-not-allowed" disabled aria-label="Locked">Locked (Requires {{ $pointsRequired }} points - Please log in)</button>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <form id="unlockCourseForm" method="POST" style="display: none;">
        @csrf
    </form>

    @vite('resources/js/app.js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.unlock-course-btn').click(function() {
                var courseSlug = $(this).data('course');
                var pointsRequired = $(this).data('points-required');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to unlock this course? This will cost " + pointsRequired + " points.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, unlock it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var $form = $('#unlockCourseForm');
                        $form.attr('action', '/unlock-course').append('<input type="hidden" name="course" value="' + courseSlug + '">');
                        $form.submit();
                    }
                })
            });
        });
    </script>

</body>
</html>
