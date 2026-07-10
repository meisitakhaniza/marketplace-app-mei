<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>📋 Riwayat Pesanan</h1>
    <a href="{{ url('/') }}" class="btn btn-secondary mb-3">← Kembali</a>

    @if($orders->isEmpty())
        <div class="alert alert-info">Belum ada pesanan.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Penjual</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->seller->name ?? 'Unknown' }}</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('chat.index', $order->id) }}" class="btn btn-sm btn-primary">💬 Chat Penjual</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>