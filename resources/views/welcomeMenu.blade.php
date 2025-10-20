@extends('layouts.templateMenu')

@section('title', 'Halaman Menu')

@section('content')
<div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-5 mt-5 md:p-4">
        @foreach ($menus as $menu)
            <div
                class="p-4 mt-5 border-2 border-transparent rounded hover:border-background shadow text-white md:w-[400px] md:h-[200px] h-[150px] flex gap-5 items-center bg-white">
                <img src="{{ $menu->foto }}" alt="{{ $menu->foto }}"
                    class="w-[125px] h-[125px]  object-cover rounded">
                <div class="text-background w-full">
                    <h2 class="text-lg md:text-xl font-bold">{{ $menu->nama }}</h2>
                    <p class="text-sm text-gray-400">{{ $menu->deskripsi }}</p>
                    <div class="md:h-10"></div>
                    <div class="flex items-center justify-between w-full mt-5">
                        <p class="md:text-xl text-[#2b2d2c]">Rp {{ number_format($menu->harga, 0, '.', '.') }}</p>
                        <button
                            class="bg-background rounded-full w-7 h-7 p-2 hover:cursor-pointer group flex justify-center"
                            @click="addToCart({ id: {{ $menu->id }}, nama: '{{ $menu->nama }}', harga: {{ $menu->harga }},foto:'{{ $menu->foto }}' })">
                            <i
                                class="fa-solid fa-plus text-sm md:text-sm hover:text-hover ease-in-out duration-300 group-hover:text-hover mx-auto text-primary"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
