@extends('layouts.app')

@section('content')
<div class="container">
    <h1>📦 Pesanan Masuk</h1>

    @if($orders->isEmpty())
        <p>Belum ada pesanan.</p>
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
@endsection