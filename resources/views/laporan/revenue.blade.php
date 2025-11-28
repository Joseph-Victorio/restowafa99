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
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Laporan Pendapatan Tahun {{ $year }}</h2>

    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($months as $i => $m)
                <tr>
                    <td>{{ $m }}</td>
                    <td>Rp {{ number_format($revenues[$i], 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Total Pendapatan Tahun {{ $year }}</th>
                <th>Rp {{ number_format($totalYearRevenue, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
