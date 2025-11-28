<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    {{-- desktop --}}
    <nav class="shadow-xl hidden md:block fixed bg-white top-0 left-0 w-full z-50">
        <div class="flex justify-between w-full px-10 py-5">
            <p class="font-bold text-background">RESTOWAFA99</p>
            <div class="flex gap-2 items-center
            ">
                <div class="relative">
                    <template x-if="cart.length !=0">
                        <div class="absolute right-[-5px] top-[-5px]">
                            <i class="fa-solid fa-circle-exclamation text-red-500 text-sm"></i>

                        </div>
                    </template>
                    <button onclick="openScanModal()">
                        <i class="fa-solid fa-bag-shopping text-background text-2xl "></i>
                    </button>
                </div>

            </div>
        </div>
        <div x-data="{
            active: '{{ request('kategori') ?? 'All' }}',
            scrollLeft() { this.$refs.container.scrollBy({ left: -200, behavior: 'smooth' }) },
            scrollRight() { this.$refs.container.scrollBy({ left: 200, behavior: 'smooth' }) }
        }" class="relative w-full bg-white border-b">

            <div
                class="absolute left-0 top-0 bottom-0 w-10 bg-gradient-to-r from-white to-transparent pointer-events-none z-10">
            </div>

            <button @click="scrollLeft"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/70 text-gray-700 rounded-full shadow p-1 z-20 hidden md:flex hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div x-ref="container"
                class="flex gap-10 overflow-x-auto scrollbar-hide scroll-smooth px-10 py-1 whitespace-nowrap">
                @php
                    use App\Models\Kategori;
                    $categories = Kategori::all();
                @endphp
                <a href="{{ route('menus.index', ['kategori' => null]) }}"
                    class="relative text-gray-500 text-xl hover:text-background transition"
                    :class="active === 'null'
                        ?
                        'text-green-500 after:content-[\'\'] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-background after:rounded-full' :
                        ''">All</a>
                @foreach ($categories as $kategori)
                    <a href="{{ route('menus.index', ['kategori' => $kategori->nama_kategori]) }}"
                        @click="active = '{{ $kategori->nama_kategori }}'"
                        class="relative text-gray-500 text-xl hover:text-background transition"
                        :class="active === '{{ $kategori->nama_kategori }}'
                            ?
                            'text-green-500 after:content-[\'\'] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-background after:rounded-full' :
                            ''">
                        {{ $kategori->nama_kategori }}
                    </a>
                @endforeach
            </div>

            <button @click="scrollRight"
                class="absolute right-0 top-1/2 -translate-y-1/2  text-gray-700   p-1 z-20 hidden md:flex rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Fade kanan --}}
            <div
                class="absolute right-0 top-0 bottom-0 w-10 bg-gradient-to-l from-white to-transparent pointer-events-none z-10">
            </div>
        </div>

    </nav>
    {{-- mobile --}}
    <nav class="shadow-xl md:hidden bg-white fixed top-0 left-0 w-full z-50">
        <div class="flex justify-between w-full px-10 py-5">
            <p class="font-bold text-background">RESTOWAFA99</p>
            <div class="flex gap-2 items-center
            ">
                <div class="relative">
                    <template x-if="cart.length !=0">
                        <div class="absolute right-[-5px] top-[-5px]">
                            <i class="fa-solid fa-circle-exclamation text-red-500 text-sm"></i>

                        </div>
                    </template>
                    <button onclick="openScanModal()">
                        <i class="fa-solid fa-bag-shopping text-background text-2xl "></i>
                    </button>
                </div>
            </div>
        </div>
        <div x-data="{
            active: '{{ request('kategori') ?? 'All' }}',
            scrollLeft() { this.$refs.container.scrollBy({ left: -200, behavior: 'smooth' }) },
            scrollRight() { this.$refs.container.scrollBy({ left: 200, behavior: 'smooth' }) }
        }" class="relative w-full bg-white border-b">

            <div
                class="absolute left-0 top-0 bottom-0 w-10 bg-gradient-to-r from-white to-transparent pointer-events-none z-10">
            </div>

            <button @click="scrollLeft"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/70 text-gray-700 rounded-full shadow p-1 z-20 hidden md:flex hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div x-ref="container"
                class="flex gap-10 overflow-x-auto scrollbar-hide scroll-smooth px-10 py-1 whitespace-nowrap">
                <a href="{{ route('menus.index', ['kategori' => null]) }}"
                    class="relative text-gray-500 text-xl hover:text-background transition"
                    :class="active === 'null'
                        ?
                        'text-green-500 after:content-[\'\'] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-background after:rounded-full' :
                        ''">All</a>
                @php

                    $categories = Kategori::all();
                @endphp

                @foreach ($categories as $kategori)
                    <a href="{{ route('menus.index', ['kategori' => $kategori->nama_kategori]) }}"
                        @click="active = '{{ $kategori->nama_kategori }}'"
                        class="relative text-gray-500 text-xl hover:text-background transition"
                        :class="active === '{{ $kategori->nama_kategori }}'
                            ?
                            'text-green-500 after:content-[\'\'] after:absolute after:left-0 after:-bottom-1 after:w-full after:h-[2px] after:bg-background after:rounded-full' :
                            ''">
                        {{ $kategori->nama_kategori }}
                    </a>
                @endforeach
            </div>

            <button @click="scrollRight"
                class="absolute right-0 top-1/2 -translate-y-1/2  text-gray-700   p-1 z-20 hidden md:flex rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            {{-- Fade kanan --}}
            <div
                class="absolute right-0 top-0 bottom-0 w-10 bg-gradient-to-l from-white to-transparent pointer-events-none z-10">
            </div>
        </div>

    </nav>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-5 mt-20 md:p-4 ">
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
                            onclick="openScanModal()">
                            <i class="fa-solid fa-plus text-sm group-hover:text-hover mx-auto text-primary"></i>
                        </button>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="scanModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-80 text-center shadow-xl">
            <h2 class="text-xl font-semibold mb-3">Perhatian</h2>
            <div class="w-[200px] mx-auto">
                <img src="{{ asset('images/warn.png') }}" alt="" class="w-full mx-auto">
            </div>
            <p class="text-gray-700 mb-4 font-bold">Harap scan barcode yang ada dimeja terlebih dahulu.</p>

            <button onclick="closeScanModal()"
                class="bg-background text-white w-full py-2 rounded-lg hover:bg-background/80 transition">
                Oke
            </button>
        </div>
    </div>
    <script>
        function openScanModal() {
            document.getElementById('scanModal').classList.remove('hidden');
        }

        function closeScanModal() {
            document.getElementById('scanModal').classList.add('hidden');
        }
    </script>

</body>

</html>
