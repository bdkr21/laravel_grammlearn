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
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    @include('components.navbar')

    <div class="container mx-auto p-5">
        <!-- Anda dapat menambahkan lebih banyak informasi kursus di sini -->
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga quibusdam autem labore, accusamus illum dolor amet esse consequuntur sequi officiis minima voluptatum, porro perferendis deleniti hic quos perspiciatis nostrum! Eveniet.</p>
    </div>

    @vite('resources/js/app.js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            console.log("DOM fully loaded and parsed");
            let startTime = Date.now();
            console.log("Start time: ", startTime);

            setTimeout(() => {
                let endTime = Date.now();
                console.log("End time: ", endTime);
                let timeSpent = (endTime - startTime) / 1000;
                console.log("Time spent: ", timeSpent);

                if (timeSpent >= 3) {
                    // toastr.success("You have spent 60 seconds on this material.");

                    givePointsToUser();
                }
            }, 3000);
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
