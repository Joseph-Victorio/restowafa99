<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('kategori.update', $kategori->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="nama" value="{{ $kategori->nama_kategori }}" class="w-full border rounded px-3 py-2 focus:ring-background focus:border-background" required>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('kategori.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-background text-white rounded hover:bg-background/80">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
