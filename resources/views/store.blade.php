<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seller->name }}'s Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(145deg, #d9e9fa 0%, #c2ddf5 100%);
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            min-height: 100vh;
        }
        .card {
            background: rgba(255,255,255,0.9);
            border-radius: 28px;
            border: none;
            transition: 0.2s;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        }
        .btn-primary {
            background-color: #5d9bc7;
            border: none;
            border-radius: 60px;
            padding: 8px 20px;
        }
        .btn-primary:hover {
            background-color: #3c7aa3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">🌸 Mei Aksesoris Shop</a>
            <a href="{{ url('/') }}" class="btn btn-outline-light">🏠 Home</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">🏪 {{ $seller->name }}'s Store</h1>

        @if($products->isEmpty())
            <p class="text-center">Belum ada produk di toko ini.</p>
        @else
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($product->image)
                                <img src="{{ asset('images/produk/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body">
    <div class="card-body">
    <h5 class="card-title">{{ $product->name }}</h5>

    <p class="card-text text-muted">
        {{ Str::limit($product->description, 80) }}
    </p>

    <p class="card-text">
        <strong>Kategori:</strong> {{ $product->category }}<br>

        <strong>Varian:</strong>
        @foreach($product->variants as $variant)
            <span class="badge bg-secondary">
                {{ $variant->variant_name }}
                (Rp {{ number_format($variant->price, 0, ',', '.') }})
            </span>
        @endforeach
    </p>

    <form action="{{ route('cart.add') }}" method="POST" class="mt-2">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="variant_name" value="{{ $product->variants[0]->variant_name }}">
        <input type="hidden" name="price" value="{{ $product->variants[0]->price }}">

        <button type="submit" class="btn btn-primary w-100">
            🛒 Tambah ke Keranjang
        </button>
    </form>
</div>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                                <p class="card-text">
                                    <strong>Kategori:</strong> {{ $product->category }}<br>
                                    <strong>Varian:</strong>
                                    @foreach($product->variants as $variant)
                                        <span class="badge bg-secondary">{{ $variant->variant_name }} (Rp {{ number_format($variant->price, 0, ',', '.') }})</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>