<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-utensils text-background"></i>
                <span>Menu Makanan</span>
            </h2>
            <a href="{{ route('menu.create') }}"
               class="inline-flex items-center gap-2 bg-background text-white px-5 py-2.5 rounded-md shadow hover:bg-background/80 transition">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Menu</span>
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
            <div class="p-5 border-b bg-gray-50 flex flex-col md:flex-row justify-between gap-3 md:items-center">
                <form method="GET" class="flex items-center gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..."
                           class="w-full md:w-64 border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-background focus:border-background">
                    <button type="submit"
                            class="bg-background text-white px-4 py-2 rounded-md hover:bg-background/80 transition">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>

                @if (session('success'))
                    <div class="text-green-600 font-medium text-sm bg-green-50 border border-green-200 px-3 py-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-background text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-5 py-3 text-center w-24">Aksi</th>
                            <th class="px-5 py-3">Nama Menu</th>
                            <th class="px-5 py-3">Kategori</th>
                            <th class="px-5 py-3">Harga</th>
                            <th class="px-5 py-3">Deskripsi</th>
                            <th class="px-5 py-3 text-center">Foto</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($menus as $menu)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('menu.edit', $menu->id) }}"
                                           class="text-blue-600 hover:text-blue-800 transition">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('menu.destroy', $menu->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus menu ini?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700 transition">
                                                <i class="fa-solid fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-5 py-3 font-medium text-gray-800">{{ $menu->nama }}</td>
                                <td class="px-5 py-3 text-gray-600">{{ $menu->kategori }}</td>
                                <td class="px-5 py-3 font-semibold text-gray-700">Rp{{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td class="px-5 py-3 text-gray-500">{{ Str::limit($menu->deskripsi, 60) }}</td>
                                <td class="px-5 py-3 text-center">
                                    <img src="{{ $menu->foto }}" alt="{{ $menu->nama }}" class="w-20 h-20 object-cover rounded border border-gray-200 shadow-sm">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    <i class="fa-solid fa-bowl-food text-2xl mb-2 block"></i>
                                    Belum ada menu makanan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5 bg-gray-50 border-t">
                {{ $menus->appends(['search' => request('search')])->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
