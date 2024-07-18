<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko - Redeem Points</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
@include('components.navbar')
<body class="bg-gray-100">
<!-- Main Content -->
<div class="container mx-auto p-5 grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Toko Items -->
    <div class="lg:col-span-3">
        <h1 class="text-2xl font-bold mb-5">Toko</h1>
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-5 relative">
                {{ session('success') }}
                <button class="absolute top-1 right-2 text-white" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-5 relative">
                {{ session('error') }}
                <button class="absolute top-1 right-2 text-white" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
            <div class="bg-white shadow-md rounded-lg p-4 relative">
                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-48 object-cover mb-4 rounded">
                <h2 class="text-xl font-bold">{{ $item->name }}</h2>
                <p class="text-gray-600">{{ $item->description }}</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-lg font-bold">{{ $item->price }} Points</span>
                    @auth
                        <form action="{{ route('shop.buy', $item->id) }}" method="POST" class="buy-form">
                            @csrf
                            <button type="button" class="buy-button bg-blue-500 text-white px-4 py-2 rounded" data-item-name="{{ $item->name }}" data-item-id="{{ $item->id }}">Beli</button>
                        </form>
                    @else
                        <button onclick="promptLoginOrSignUp()" class="bg-blue-500 text-white px-4 py-2 rounded">Beli</button>
                    @endauth
                </div>
                <span class="absolute top-0 right-0 m-2 bg-yellow-400 text-black px-2 py-1 rounded">New</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- User Info & More Points -->
    <div class="space-y-6">
        @auth
        <!-- User Info -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <h2 class="text-white text-xl font-bold">{{ Auth::user()->name }}</h2>
            <p class="text-white">Welcome</p>
            <p class="text-white">MY POINT: {{ Auth::user()->points }}</p>
            <button class="bg-gray-700 text-white px-4 py-2 rounded mt-2" id="openModal">Panduan Perolehan Poin</button>
        </div>
        @else
        <!-- Login Prompt -->
        <div class="bg-gray-800 p-4 rounded-lg">
            <h2 class="text-white text-xl font-bold">Welcome, Guest</h2>
            <p class="text-white mb-4">Toko poin hanya tersedia setelah Login</p>
            <a href="{{ url('/login') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-2 inline-block">Log In</a>
        </div>
        @endauth
    </div>
</div>

<!-- Modal -->
<div id="pointGuideModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-xl max-w-lg w-full relative">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4 text-white">Panduan Perolehan Poin</h2>
            <ul class="space-y-4">
                <li class="text-white flex justify-between"><span>Login</span><span class="text-red-500">+20 Points</span></li>
                <li class="text-white flex justify-between"><span>Baca Materi</span><span class="text-red-500">+10 Points</span></li>
                <li class="text-white flex justify-between"><span>Menyelesaikan Kuis</span><span class="text-red-500">+30 Points</span></li>
            </ul>
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-white">Hal-hal yang Perlu Diperhatikan</h3>
                <ol class="list-decimal list-inside space-y-2 text-white">
                    <li>Membaca materi diberikan hingga 50 poin per hari.</li>
                    <li>Poin tidak dapat diperoleh jika belum melakukan login atau signup</li>
                    <li>Poin yang telah digunakan akan dikurangi ketika membeli item.</li>
                </ol>
            </div>
        </div>
        <button id="closeModal" class="absolute top-2 right-2 text-gray-400 hover:text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    // Konfirmasi pembelian menggunakan SweetAlert
    document.querySelectorAll('.buy-button').forEach(button => {
        button.addEventListener('click', async function (event) {
            event.preventDefault();
            var form = this.closest('form');
            var itemName = this.getAttribute('data-item-name');

            const willBuy = await swal({
                title: "Are you sure?",
                text: `Do you want to redeem ${itemName} with your points?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });

            if (willBuy) {
                form.submit();
            }
        });
    });

    // SweetAlert untuk login atau sign up
    async function promptLoginOrSignUp() {
        const value = await swal({
            title: 'Not logged in',
            text: "You need to log in or sign up to redeem this item.",
            icon: 'info',
            buttons: {
                cancel: {
                    text: "Sign Up",
                    value: 'sign_up',
                    visible: true,
                    className: "bg-blue-500 text-white px-4 py-2 rounded",
                    closeModal: true
                },
                confirm: {
                    text: "Login",
                    value: 'login',
                    visible: true,
                    className: "bg-green-500 text-white px-4 py-2 rounded",
                    closeModal: true
                }
            }
        });

        switch (value) {
            case 'login':
                window.location.href = '{{ route('login') }}';
                break;
            case 'sign_up':
                window.location.href = '{{ route('register') }}';
                break;
            default:
                break;
        }
    }

    // Toastr notification for session messages
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    // Toggle modal
    document.getElementById('openModal').addEventListener('click', function() {
        document.getElementById('pointGuideModal').classList.remove('hidden');
    });
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('pointGuideModal').classList.add('hidden');
    });
</script>

</body>
</html>
