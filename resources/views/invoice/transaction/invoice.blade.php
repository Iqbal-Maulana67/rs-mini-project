<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border-bottom: 1px solid #ddd;
            padding: 6px;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>

    <h3>NOTA TRANSAKSI</h3>

    <p>
        No Transaksi : {{ $transaction->transaction_number }}<br>
        Tanggal : {{ $transaction->created_at->format('d-m-Y H:i') }}<br>
        Kasir : {{ $transaction->cashier->name }}<br>
        Pasien : {{ $transaction->patient_name }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Jasa</th>
                <th class="right">Harga</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->items as $item)
                <tr>
                    <td>{{ $item->procedure_name }}</td>
                    <td class="right">Rp {{ number_format($item->price) }}</td>
                    <td class="right">Rp {{ number_format($item->total) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <table>
        <tr>
            <td>Subtotal</td>
            <td class="right">Rp {{ number_format($transaction->subtotal) }}</td>
        </tr>
        <tr>
            <td>Discount</td>
            <td class="right">Rp {{ number_format($transaction->discount) }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <th class="right">Rp {{ number_format($transaction->total) }}</th>
        </tr>
    </table>

</body>

</html>
