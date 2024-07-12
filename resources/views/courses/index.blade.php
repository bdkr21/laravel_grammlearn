<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    @include('components.navbar')

    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-5">Course overview</h1>
        <ul class="flex space-x-4 mb-5 border-b">
            <li class="pb-2 border-b-2 border-blue-500"><a href="#" class="text-blue-500">All</a></li>
        </ul>
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($grammarTopics as $category => $courses)
                    @foreach($courses as $course)
                        @if(isset($course->title))
                        <div class="bg-white p-4 rounded shadow relative w-full mx-auto">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h5 class="text-lg font-bold"><a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a></h5>
                                    <p>{{ $course->description }}</p>
                                </div>
                            </div>
                            <div class="relative mb-4">
                                <div id="dropdownMenu{{ $loop->index }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Star this course</a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Unstar this course</a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Restore to view</a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Remove from view</a>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <button onclick="confirmAccess('{{ route('courses.show', $course->id) }}')" class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Get access
                                </button>
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
        function toggleDropdown(event, index) {
            event.preventDefault();
            event.stopPropagation();
            const dropdown = document.getElementById('dropdownMenu' + index);
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('click', function(event) {
                const dropdowns = document.querySelectorAll('[id^="dropdownMenu"]');
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            });
        });

        function confirmAccess(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to get access to this course?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, get access!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            })
        }
    </script>
</body>
</html>
