<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6 lg:px-10">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-tags text-background"></i>
                <span>Daftar Kategori</span>
            </h2>

            <a href="{{ route('kategori.create') }}"
               class="inline-flex items-center gap-2 bg-background text-white px-5 py-2.5 rounded-md shadow hover:bg-background/80 transition">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Kategori</span>
            </a>
        </div>

        {{-- Card Container --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">

            {{-- Header Filter --}}
            <div class="p-5 border-b bg-gray-50 flex flex-col md:flex-row justify-between gap-3 md:items-center">
                <form method="GET" class="flex items-center gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                           class="w-full md:w-64 border-gray-300 rounded-md shadow-sm px-3 py-2 focus:ring-background focus:border-background">
                    <button type="submit"
                            class="bg-background text-white px-4 py-2 rounded-md hover:bg-background/80 transition">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>

                @if(session('success'))
                    <div class="text-green-600 font-medium text-sm bg-green-50 border border-green-200 px-3 py-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-background text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-5 py-3 w-16 text-center">ID</th>
                            <th class="px-5 py-3">Nama Kategori</th>
                            <th class="px-5 py-3 text-center w-32">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($kategoris as $kategori)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3 text-center font-semibold text-gray-600">
                                    {{ $kategori->id }}
                                </td>
                                <td class="px-5 py-3 text-gray-800 font-medium">
                                    {{ $kategori->nama_kategori }}
                                </td>
                                <td class="px-5 py-3 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                           class="text-blue-600 hover:text-blue-800 transition">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus kategori ini?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700 transition">
                                                <i class="fa-solid fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-6 text-gray-500">
                                    <i class="fa-solid fa-folder-open text-2xl mb-2 block"></i>
                                    Belum ada kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-5 bg-gray-50 border-t">
                {{ $kategoris->appends(['search' => request('search')])->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
