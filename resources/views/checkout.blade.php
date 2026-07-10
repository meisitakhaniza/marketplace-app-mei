<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Mei Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>🛒 Checkout</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <h4>Rincian Pesanan</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Varian</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($order->items as $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $item['product_id'] }}</td>
                            <td>{{ $item['variant_name'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5>Total Belanja: Rp {{ number_format($total, 0, ',', '.') }}</h5>
            <h4>Total yang harus dibayar: Rp {{ number_format($total, 0, ',', '.') }}</h4>
        </div>

        <div class="col-md-4">
            <h4>Pembayaran via QRIS</h4>

            @if($sellerQris)
                <img src="{{ asset('storage/qris/' . $sellerQris) }}" alt="QRIS" class="img-fluid">
                <p class="mt-2">Scan QRIS di atas menggunakan aplikasi perbankan.</p>
                <p><strong>Setelah transfer, kirim bukti pembayaran ke penjual melalui chat.</strong></p>
                <a href="{{ route('chat.index', $order->id) }}" class="btn btn-primary">💬 Kirim Bukti Bayar</a>
            @else
                <div class="alert alert-warning">Penjual belum mengupload QRIS. Silakan hubungi penjual.</div>
            @endif
        </div>
    </div>

    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
</body>
</html>