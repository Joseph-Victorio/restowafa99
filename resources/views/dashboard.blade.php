<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-10">


        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-background"></i>
                <span>Dashboard</span>
            </h2>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10 place-items-center">
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-background w-full">
                <p class="text-gray-500 text-sm">Pesanan Hari Ini</p>
                <h3 class="text-3xl font-bold text-green-600">{{ $todayOrders }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-background w-full">
                <p class="text-gray-500 text-sm">Pending</p>
                <h3 class="text-3xl font-bold text-green-600">{{ $pendingOrders }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-background w-full">
                <p class="text-gray-500 text-sm">Cooked</p>
                <h3 class="text-3xl font-bold text-background">{{ $cookedOrders }}</h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-green-500 w-full">
                <p class="text-gray-500 text-sm">Pendapatan Hari Ini</p>
                <h3 class="text-3xl font-bold text-green-600">
                    Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                </h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-green-500 w-full">
                <p class="text-gray-500 text-sm">Pendapatan Bulan Ini</p>
                <h3 class="text-3xl font-bold text-green-600">
                    Rp {{ number_format($monthRevenue, 0, ',', '.') }}
                </h3>
            </div>
            <div class="bg-white shadow rounded-lg p-5 border-l-4 border-green-500 w-full">
                <p class="text-gray-500 text-sm">Pendapatan Tahun Ini</p>
                <h3 class="text-3xl font-bold text-green-600">
                    Rp {{ number_format($yearRevenue, 0, ',', '.') }}
                </h3>
            </div>
        </div>

        <div x-data="revenueFilter()" class="flex gap-3 mb-5">
            <select x-model="month" @change="loadData" class="px-3 pr-10 py-2 border rounded">
                <option value="">Pilih Bulan</option>
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}">{{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                @endforeach
            </select>

            <select x-model="year" @change="loadData" class="px-3 py-2 border rounded">
                <option value="">Pilih Tahun</option>
                @foreach (range(date('Y') - 5, date('Y')) as $y)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
            <a href="{{ route('dashboard.laporan', ['year' => now()->year]) }}"
                class="px-4 py-2 text-sm bg-green-600 text-white rounded">
                Download Laporan Tahunan
            </a>
            <a :href="`/dashboard/laporan-bulanan?month=${month}&year=${year}`"
                class="px-4 py-2 text-sm bg-green-600 text-white rounded">
                Download Laporan Bulanan
            </a>



        </div>
        <canvas id="revenueChart" class="bg-white p-5 mt-5 rounded shadow-sm"></canvas>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200 mt-5">
            <div class="p-5 border-b bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center gap-2">
                    <i class="fa-solid fa-receipt text-background"></i>
                    <span>Pesanan Terbaru</span>
                </h3>
                <a href="{{ route('orders.index') }}" class="text-background hover:underline text-sm font-semibold">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-background text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-5 py-3">Nomor</th>
                            <th class="px-5 py-3">Meja</th>
                            <th class="px-5 py-3">Status</th>
                            <th class="px-5 py-3 text-center">Status Pembayaran</th>
                            <th class="px-5 py-3">Total</th>
                            <th class="px-5 py-3">Menu</th>
                            <th class="px-5 py-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3 font-medium text-gray-800">#{{ $order->id }}</td>
                                <td class="px-5 py-3 text-xs text-center">Meja {{ $order->meja_id }}</td>
                                <td class="px-5 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-semibold
                                        @if ($order->status === 'pending') bg-yellow-100 text-yellow-600
                                        @elseif($order->status === 'cooked') bg-background text-white @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-semibold
                                        @if ($order->status_pembayaran === 'belum_dibayar') bg-yellow-100 text-yellow-600
                                        @elseif($order->status_pembayaran === 'sudah_dibayar') bg-background text-white @endif">
                                        @if ($order->status_pembayaran == 'belum_dibayar')
                                            Belum Dibayar
                                        @elseif ($order->status_pembayaran == 'sudah_dibayar')
                                            Sudah Dibayar
                                        @endif
                                    </span>
                                </td>
                                <td class="px-5 py-3 font-semibold">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-5 py-3">
                                    <ul class="list-disc list-inside text-gray-600 text-xs">
                                        @foreach ($order->items as $item)
                                            <li>{{ $item->nama_menu }} (x{{ $item->qty }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-5 py-3 text-gray-500 text-xs text-center">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Belum ada pesanan terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            function revenueFilter() {
                return {
                    month: new Date().getMonth() + 1,
                    year: new Date().getFullYear(),
                    chart: null,

                    init() {
                        this.renderChart(@json($days), @json($revenues));
                    },

                    loadData() {
                        fetch(`/dashboard/revenue?month=${this.month}&year=${this.year}`)
                            .then(res => res.json())
                            .then(data => {
                                this.renderChart(data.days, data.revenues);
                            });
                    },

                    renderChart(days, revenues) {
                        if (this.chart) this.chart.destroy();

                        const ctx = document.getElementById('revenueChart');

                        this.chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: days,
                                datasets: [{
                                    label: `Pendapatan`,
                                    data: revenues,
                                    borderWidth: 2,
                                    borderColor: 'rgba(34, 197, 94, 1)',
                                    backgroundColor: 'rgba(34, 197, 94, 0.3)',
                                    fill: true,
                                    tension: 0.3,
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        ticks: {
                                            callback: function(value) {
                                                return new Intl.NumberFormat('id-ID', {
                                                    style: 'currency',
                                                    currency: 'IDR',
                                                    minimumFractionDigits: 0
                                                }).format(value);
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                let value = context.parsed.y;
                                                return new Intl.NumberFormat('id-ID', {
                                                    style: 'currency',
                                                    currency: 'IDR',
                                                    minimumFractionDigits: 0
                                                }).format(value);
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }

                }
            }
        </script>



    </div>
</x-app-layout>
