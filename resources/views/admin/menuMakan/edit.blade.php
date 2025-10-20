<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu Makanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('menu.update', $menu->id) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700">Nama Menu</label>
                        <input type="text" name="nama" value="{{ $menu->nama }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Kategori</label>
                        <input type="text" name="kategori" value="{{ $menu->kategori }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Harga</label>
                        <input type="number" name="harga" value="{{ $menu->harga }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full border rounded px-3 py-2">{{ $menu->deskripsi }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto" class="w-full border rounded px-3 py-2">
                        <img src="{{ $menu->foto }}" alt="{{ $menu->nama }}" class="w-32 mt-3 rounded">
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('menu.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-background text-white rounded hover:bg-background/80">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
