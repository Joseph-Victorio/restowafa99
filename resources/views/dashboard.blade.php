<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-10">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-background"></i>
                <span>Dashboard</span>
            </h2>
        </div>

        {{-- STATISTICS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-background">
                <p class="text-gray-500 text-sm">Pesanan Hari Ini</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $todayOrders }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-yellow-400">
                <p class="text-gray-500 text-sm">Pending</p>
                <h3 class="text-3xl font-bold text-yellow-500">{{ $pendingOrders }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-background">
                <p class="text-gray-500 text-sm">Cooked</p>
                <h3 class="text-3xl font-bold text-background">{{ $cookedOrders }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-green-500">
                <p class="text-gray-500 text-sm">Pendapatan Hari Ini</p>
                <h3 class="text-3xl font-bold text-green-600">
                    Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                </h3>
            </div>
        </div>

        {{-- RECENT ORDERS --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="p-5 border-b bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-receipt text-background"></i>
                    <span>Pesanan Terbaru</span>
                </h3>
                <a href="{{ route('orders.index') }}"
                   class="text-background hover:underline text-sm font-semibold">
                   Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-background text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-5 py-3">Nomor</th>
                            <th class="px-5 py-3">Meja</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Menu</th>
                            <th class="px-5 py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3 font-medium text-gray-800">#{{ $order->id }}</td>
                                <td class="px-5 py-3">Meja {{ $order->meja_id }}</td>
                                <td class="px-5 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($order->status === 'pending') bg-yellow-100 text-yellow-600
                                        @elseif($order->status === 'cooked') bg-background text-white
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3 font-semibold">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-3">
                                    <ul class="list-disc list-inside text-gray-600 text-xs">
                                        @foreach ($order->items as $item)
                                            <li>{{ $item->nama_menu }} (x{{ $item->qty }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-5 py-3 text-gray-500 text-xs">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Belum ada pesanan terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
