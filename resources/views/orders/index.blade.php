<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-clipboard-list text-background"></i>
                <span>Daftar Pesanan</span>
            </h2>
        </div>

        @if (session('success'))
            <div class="mb-6 text-green-700 bg-green-50 border border-green-200 px-4 py-2 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-background text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-5 py-3 text-center w-1/12 text-[12px]">No. Pesanan</th>
                            <th class="px-5 py-3 w-2/12">No. Meja</th>
                            <th class="px-5 py-3 w-4/12">Daftar Menu</th>
                            <th class="px-5 py-3 w-2/12">Total Harga</th>
                            <th class="px-5 py-3 w-1/12">Status</th>
                            <th class="px-5 py-3 w-2/12 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($orders as $order)
                            <tr
                                class="hover:bg-gray-50 transition 
                                @if ($order->status == 'pending') bg-yellow-50
                                @elseif($order->status == 'cooked') bg-background/10 @endif">

                                <td class="px-5 py-3 font-semibold text-gray-700 text-center">#{{ $order->id }}</td>
                                <td class="px-5 py-3">Meja {{ $order->meja_id }}</td>

                                <td class="px-5 py-3">
                                    <ul class="list-disc list-inside text-gray-700 text-sm space-y-1">
                                        @foreach ($order->items as $item)
                                            <li>
                                                <span class="font-medium">{{ $item->nama_menu }}</span>
                                                <span class="text-gray-500">(x{{ $item->qty }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <td class="px-5 py-3 font-semibold text-gray-700">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-3">
                                    <span
                                        class="px-2 py-1 text-sm font-semibold rounded 
                                        @if ($order->status == 'pending') bg-yellow-100 text-yellow-500
                                        @elseif($order->status == 'cooked') bg-background text-white @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-3 text-center">
                                    @if ($order->status == 'pending')
                                        <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}"
                                            class="inline-flex items-center justify-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status"
                                                class="border-gray-300 rounded-md shadow-sm px-2 py-1 text-sm focus:ring-background focus:border-background">
                                                <option value="pending" selected>Pending</option>
                                                <option value="cooked">Cooked</option>
                                            </select>
                                            <button type="submit"
                                                class="bg-background text-white px-3 py-1 rounded-md hover:bg-background/80 transition">
                                                Update
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-sm text-gray-400 italic">Sudah selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    <i class="fa-solid fa-receipt text-2xl mb-2 block"></i>
                                    Belum ada pesanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
