<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang - Mei Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(145deg, #d9e9fa 0%, #c2ddf5 100%);
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 28px;
        border: none;
        transition: 0.2s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.03);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    .navbar {
        background-color: white !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .navbar-brand, .nav-link {
        color: #2c5a7a !important;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #5d9bc7;
        border: none;
        border-radius: 60px;
        padding: 6px 16px;
    }

    .btn-primary:hover {
        background-color: #3c7aa3;
    }

    .badge.bg-secondary {
        background-color: #cde4f5 !important;
        color: #2c5a7a;
        font-weight: 500;
        border-radius: 40px;
        padding: 5px 12px;
    }

    h1, h2 {
        color: #1f4e6e;
        font-weight: 600;
    }

    .btn-outline-light {
        color: #2c5a7a;
        border-color: #5d9bc7;
    }

    .btn-outline-light:hover {
        background-color: #5d9bc7;
        color: white;
    }

    .table {
        background-color: white;
        border-radius: 24px;
        overflow: hidden;
    }

    .alert-info {
        background-color: #e3f0fa;
        color: #1f4e6e;
        border: none;
    }
</style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">🌸 Mei Aksesoris Shop 🌸</a>
        <a href="{{ url('/') }}" class="btn btn-outline-light">🏠 Home</a>
    </div>
</nav>

<div class="container mt-4">
    <h2>🛒 Keranjang Belanja</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(isset($cart) && count($cart) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Varian</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $key => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['product_id'] }}</td>
                        <td>{{ $item['variant_name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $key) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
        <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
    @else
        <div class="alert alert-info">Keranjang masih kosong. Yuk tambahin produk!</div>
    @endif
</div>

</body>
</html>