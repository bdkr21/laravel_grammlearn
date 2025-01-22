<x-app-layout>
    <div class="flex flex-col lg:flex-row gap-6 bg-gray-50 min-h-screen">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Content -->
        <div class="flex-1 bg-white shadow-lg rounded-lg p-6">
            <!-- Table -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                        @if($historyRedeems->isEmpty())
                            <p>{{ __('No items have been redeemed yet.') }}</p>
                        @else
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Item Name') }}
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Redeemed At') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($historyRedeems as $history)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $history->item->name }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $history->redeemed_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Controls -->
                            <div class="mt-4">
                                {{ $historyRedeems->links() }} <!-- Tampilkan kontrol paginasi -->
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
