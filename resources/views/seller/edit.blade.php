<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Produk</h1>

    <form action="{{ route('seller.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="category" class="form-control" value="{{ $product->category }}" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="price" class="form-control" value="{{ $product->variants->first()->price ?? 0 }}" required>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->variants->first()->stock ?? 0 }}" required>
        </div>

        <div class="mb-3">
            <label>Nama Varian</label>
            <input type="text" name="variant_name" class="form-control" value="{{ $product->variants->first()->variant_name ?? 'Default' }}">
        </div>

        <div class="mb-3">
            <label>Foto Produk</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Produk</button>
        <a href="{{ route('seller.dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>