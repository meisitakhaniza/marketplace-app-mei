<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Seller</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(145deg, #d9e9fa 0%, #c2ddf5 100%);
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }
    .card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border-radius: 32px;
        border: none;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }
    h1, p {
        color: #1f4e6e;
    }
</style>
</head>
<body>
<div class="container mt-5">
    <h1>Dashboard Seller</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>

    <form action="{{ route('switch.role') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-outline-danger">
        @if(auth()->user()->role == 'seller')
            🔄 Jadi Customer
        @else
            🔄 Jadi Seller
        @endif
    </button>
</form>

    <a href="{{ url('/seller/create') }}" class="btn btn-success">+ Tambah Produk</a>
    <a href="{{ route('seller.orders') }}" class="btn btn-info">📦 Pesanan Masuk</a>

    <hr>

    <h3>Daftar Produk ({{ $products->count() }})</h3>

    @if($products->isEmpty())
        <div class="alert alert-warning">Belum ada produk.</div>
    @else
        @foreach($products as $product)
            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <span>
                    <strong>{{ $product->name }}</strong> - {{ $product->category }}
                </span>
                <div>
                    <a href="{{ route('seller.edit', $product->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                    <form action="{{ route('seller.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus produk ini?')">🗑️ Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

    <hr>
    <h3>Upload QRIS</h3>
    <form action="{{ route('seller.upload.qris') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Upload QRIS</label>
            <input type="file" name="qris_image" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan QRIS</button>
    </form>

    @if(auth()->user()->qris_image)
        <div class="mt-3">
            <p><strong>QRIS saat ini:</strong></p>
            <img src="{{ asset('storage/qris/' . auth()->user()->qris_image) }}" alt="QRIS" style="max-width: 200px;">
        </div>
    @endif

</div>
</body>
</html>