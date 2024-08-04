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
<div class="pagination">
    {{ $items->links() }}
</div>
