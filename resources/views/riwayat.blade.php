@extends('layouts.templateMenu')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4 text-background">
            Riwayat Pesanan Meja {{ $meja_id }}
        </h2>

        @if ($orders)
            @if ($orders->status === 'pending')
                <div class="border-b border-gray-200 pb-3 mb-3">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('images/food_cooking.png') }}" alt="Sedang dimasak" class="w-[250px]">
                    </div>
                    <p class="text-center text-3xl font-semibold">Makanan sedang dimasak!</p>
                    <p class="text-center md:text-lg text-gray-500">Mohon bersabar, makanan anda sedang dimasak.</p>

                    <div class="flex justify-between items-center mt-8">
                        <p class="font-semibold text-gray-700">Nomor Pesanan: <span class="text-background">#{{ $orders->id }}</span></p>
                    </div>

                    <div class="mt-4 border-t pt-3 space-y-2">
                        @foreach ($orders->items as $item)
                            <div class="flex justify-between text-sm text-gray-700">
                                <span>{{ $item->nama_menu }} (x{{ $item->qty }})</span>
                                <div class="text-right">
                                    <p>Rp {{ number_format($item->harga, 0, ',', '.') }} <span class="text-gray-400">/item</span></p>
                                    <p class="font-semibold">Rp {{ number_format($item->harga * $item->qty, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3 font-semibold text-right text-background text-lg">
                        Total: Rp {{ number_format($orders->total_harga, 0, ',', '.') }}
                    </div>
                </div>
            @endif

            @if ($orders->status === 'cooked')
                <div class="border-b border-gray-200 pb-3 mb-3">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('images/food_ready.png') }}" alt="Makanan siap" class="w-[250px]">
                    </div>
                    <p class="text-center text-3xl font-semibold text-background">Makanan sudah siap!</p>
                    <p class="text-center md:text-lg text-gray-500">Makanan anda sedang diantar ke meja anda.</p>

                    <div class="flex justify-between items-center mt-8">
                        <p class="font-semibold text-gray-700">Nomor Pesanan: <span class="text-background">#{{ $orders->id }}</span></p>
                       
                    </div>

                    <div class="mt-4 border-t pt-3 space-y-2">
                        @foreach ($orders->items as $item)
                            <div class="flex justify-between text-sm text-gray-700">
                                <span>{{ $item->nama_menu }} (x{{ $item->qty }})</span>
                                <div class="text-right">
                                    <p>Rp {{ number_format($item->harga, 0, ',', '.') }} <span class="text-gray-400">/item</span></p>
                                    <p class="font-semibold">Rp {{ number_format($item->harga * $item->qty, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3 font-semibold text-right text-background text-lg">
                        Total: Rp {{ number_format($orders->total_harga, 0, ',', '.') }}
                    </div>
                </div>
            @endif
        @else
            <p class="text-center text-gray-500">Belum ada pesanan untuk meja ini.</p>
        @endif
    </div>
@endsection
