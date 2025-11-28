<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Laporan Pendapatan Bulan {{ \Carbon\Carbon::create(null, $month, 1)->translatedFormat('F') }}
        {{ $year }}</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($days as $i => $day)
                <tr>
                    <td>{{ $day }}</td>
                    <td>Rp {{ number_format($revenues[$i], 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr>
                <th>Total Bulanan</th>
                <th>Rp {{ number_format($totalMonthlyRevenue, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
