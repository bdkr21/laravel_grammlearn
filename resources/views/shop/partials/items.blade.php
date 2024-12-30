<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($items as $item)
    <div class="bg-white shadow-md rounded-lg p-4 relative hover:shadow-lg transition-shadow">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-800">{{ $item->name }}</h2>
            <span class="text-sm text-green-600 bg-green-100 px-2 py-1 rounded-full">{{ $item->quantity > 0 ? 'Tersedia' : 'Habis' }}</span>
        </div>
        <div class="text-gray-600 mb-4">
            <p>Harga: <span class="text-lg font-bold text-blue-500">{{ $item->price }} Points</span></p>
        </div>
        <div class="mt-4 flex items-center justify-between">
            @auth
                <form action="{{ route('shop.buy', $item->id) }}" method="POST" class="buy-form">
                    @csrf
                    <button type="button" class="buy-button bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors"
                            data-item-name="{{ $item->name }}" data-item-id="{{ $item->id }}">
                        Beli
                    </button>
                </form>
            @else
                <button onclick="promptLoginOrSignUp()"
                        class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">
                    Login untuk Membeli
                </button>
            @endauth
        </div>
    </div>
    @endforeach
</div>
<div class="pagination mt-6 flex justify-center">
    {{ $items->links() }}
</div>
