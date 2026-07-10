<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Bukti Bayar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>💬 Chat - Order #{{ $order->id }}</h2>
    <p><strong>Penjual:</strong> {{ $order->seller->name }}</p>
    <p><strong>Pembeli:</strong> {{ $order->buyer->name }}</p>

    <div class="border p-3 mb-3" style="max-height: 400px; overflow-y: scroll;">
        @foreach($chats as $chat)
            <div class="mb-2">
                <strong>{{ $chat->sender->name }}:</strong>
                @if($chat->message)
                    <span>{{ $chat->message }}</span>
                @endif
                @if($chat->image)
                    <br>
                    <img src="{{ asset('storage/' . $chat->image) }}" alt="Bukti" width="200" class="mt-1">
                @endif
                <br><small class="text-muted">{{ $chat->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.store', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <textarea name="message" class="form-control" placeholder="Tulis pesan..."></textarea>
        </div>
        <div class="mb-2">
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>