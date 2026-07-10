<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Masuk - Seller</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>📦 Pesanan Masuk</h1>
    <a href="{{ url('/seller/dashboard') }}" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>

    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Pembeli</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->buyer->name ?? 'Unknown' }}</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('chat.index', $order->id) }}" class="btn btn-sm btn-primary">💬 Chat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>