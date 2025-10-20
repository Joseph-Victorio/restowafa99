<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body class=" font-roboto bg-gray-100" x-data="window.cartAppInstance">
    {{-- desktop --}}
    <nav class="shadow-xl hidden md:block bg-white">
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
                    <button @click="openCart=true">
                        <i class="fa-solid fa-bag-shopping text-background text-2xl "></i>
                    </button>
                </div>
                <p> Meja: {{ $meja_id }}</p>
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
    <nav class="shadow-xl  md:hidden bg-white">
        <div class="flex justify-between w-full px-10 py-5">
            <p class="font-bold text-background">RESTOWAFA99</p>
            <div class="flex gap-2 items-center
            ">
                <div class="relative">
                    <div x-if="cart.length > 0" class="absolute left-0">

                    </div>
                    <button @click="openCart=true">
                        <i class="fa-solid fa-bag-shopping text-background text-2xl "></i>
                    </button>
                </div>
                <p>Meja: {{ $meja_id }}</p>
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


    <div x-show="openCart" x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform transition ease-in duration-300"
        x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
        class="fixed top-0 right-0 h-full w-full sm:w-1/2 md:w-1/3 bg-white shadow-xl z-50 p-5">

        <div class="flex justify-between items-center mb-4">
            <button @click="openCart = false" class="text-gray-500 hover:text-black">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <template x-if="cart.length === 0">
            <div class="text-center">
                <img src="{{ asset('images/empty_cart.png') }}" alt="" class="w-[300px] mx-auto">
                <p class="text-2xl text-black">Pesan Makan Yuk!</p>
                <p class="text-gray-400 text-sm">Tambahkan makanan ke keranjang mu dan pesan disini</p>
            </div>
        </template>

        <template x-for="item in cart" :key="item.id">
            <div class="flex justify-between items-center border-b py-3 ">
                <div class="flex items-center gap-3">
                    <img :src="item.foto" alt="" class="w-12 h-12 object-cover rounded-md">
                    <div>
                        <span x-text="item.nama" class="font-medium block"></span>
                        <span x-text="`Rp ${(item.harga * item.qty).toLocaleString()}`"
                            class="text-gray-600 text-sm"></span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button @click="decreaseQty(item.id)"
                        class="bg-gray-200 text-gray-700 px-2 rounded hover:bg-gray-300">-</button>
                    <span x-text="item.qty" class="w-6 text-center"></span>
                    <button @click="increaseQty(item.id)"
                        class="bg-background text-white px-2 rounded hover:bg-background/80">+</button>
                </div>
            </div>
        </template>

        <template x-if="cart.length > 0">
            <div class="mt-6 border-t pt-4">
                <div class="flex justify-between text-lg font-semibold">
                    <span>Total:</span>
                    <span x-text="`Rp ${totalHarga.toLocaleString()}`"></span>
                </div>
                <button @click="clearCart"
                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                    Hapus Semua
                </button>

                <div class="mt-10 w-full">
                    <button @click="checkout()"
                        class="bg-background w-full text-white px-4 py-2 rounded hover:bg-background/80 ease-in-out transition-colors duration-300 ">
                        Pesan Sekarang
                    </button>
                </div>
            </div>

        </template>
    </div>

    <div x-show="showNotif" x-transition
        class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50" x-text="notifMessage">
    </div>


    </div>

    <div class="p-4 z-0 relative ">
        @yield('content')
    </div>

    <script>
        window.cartAppInstance = {
            openModal: false,
            openCart: false,
            cart: JSON.parse(localStorage.getItem('cart') || '[]'),
            showNotif: false,
            notifMessage: '',

            get totalHarga() {
                return this.cart.reduce((sum, item) => sum + item.harga * item.qty, 0);
            },

            saveCart() {
                localStorage.setItem('cart', JSON.stringify(this.cart));
            },

            addToCart(item) {
                const existing = this.cart.find(i => i.id === item.id);
                if (existing) {
                    existing.qty++;
                } else {
                    this.cart.push({
                        ...item,
                        qty: 1
                    });
                }

                this.saveCart();

                this.notifMessage = `${item.nama} berhasil ditambahkan!`;
                this.showNotif = true;
                setTimeout(() => this.showNotif = false, 2000);
                this.openCart = true;
            },

            increaseQty(id) {
                const item = this.cart.find(i => i.id === id);
                if (item) {
                    item.qty++;
                    this.saveCart();
                }
            },

            decreaseQty(id) {
                const item = this.cart.find(i => i.id === id);
                if (item) {
                    item.qty--;
                    if (item.qty <= 0) {
                        this.cart = this.cart.filter(i => i.id !== id);
                    }
                    this.saveCart();
                }
            },

            clearCart() {
                this.cart = [];
                localStorage.removeItem('cart');
            },
            checkout() {
                fetch('{{ route('checkout') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            meja_id: '{{ $meja_id }}',
                            cart: this.cart
                        })
                    })
                    .then(res => res.json())
                    .then(async data => {
                        if (data.success) {
                            this.notifMessage = 'Memproses pembayaran...';
                            this.showNotif = true;

                            await this.loadSnap();
                            window.snap.pay(data.snapToken, {
                                onSuccess: (result) => {
                                    this.clearCart();
                                    this.notifMessage = 'Pembayaran Berhasil!';
                                    this.showNotif = true;
                                    setTimeout(() => {
                                        window.location.href =
                                            "{{ route('riwayat', ['meja_id' => $meja_id]) }}";
                                    }, 1500);
                                },
                                onPending: () => {
                                    this.notifMessage = 'Menunggu Pembayaran...';
                                },
                                onError: () => {
                                    this.notifMessage = 'Terjadi kesalahan pembayaran.';
                                }
                            });
                        } else {
                            alert('Gagal checkout: ' + data.message);
                        }
                    });
            },
            async loadSnap() {
                if (!window.snap) {
                    await new Promise(resolve => {
                        const script = document.createElement('script');
                        script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
                        script.setAttribute('data-client-key',
                            '{{ config('services.midtrans.clientKey') }}');
                        script.onload = resolve;
                        document.head.appendChild(script);
                    });
                }
            }


        };
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
