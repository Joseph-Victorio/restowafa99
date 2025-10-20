<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Menu Makanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data" class="space-y-5" autocomplete="off">
                    @csrf

                    <div>
                        <label class="block font-medium text-gray-700">Nama Menu</label>
                        <input type="text" name="nama" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Kategori</label>
                        <select name="kategori" id="" class="w-full rounded">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->nama_kategori }}"
                                    {{ old('kategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full border rounded px-3 py-2"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('menu.index') }}"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                        <button type="submit"
                            class="px-4 py-2 bg-background text-white rounded hover:bg-background/80">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
