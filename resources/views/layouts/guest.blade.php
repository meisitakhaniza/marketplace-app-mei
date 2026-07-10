<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  
      <style>
    body {
        background: linear-gradient(145deg, #d9e9fa 0%, #c2ddf5 100%);
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .card, .bg-white {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(12px);
        border-radius: 32px;
        border: none;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
    }

    .btn-primary, .btn-indigo {
        background-color: #5d9bc7 !important;
        border: none !important;
        border-radius: 60px !important;
        padding: 10px 24px !important;
        width: 100%;
    }

    .btn-primary:hover, .btn-indigo:hover {
        background-color: #3c7aa3 !important;
    }

    a {
        color: #2c5a7a;
        text-decoration: none;
    }

    a:hover {
        color: #1f4e6e;
        text-decoration: underline;
    }

    .form-control, .rounded, .shadow-sm {
        border-radius: 40px !important;
        padding: 12px 20px !important;
        border: 1px solid #d4e4f0 !important;
    }

    .form-control:focus {
        border-color: #5d9bc7 !important;
        box-shadow: 0 0 0 3px rgba(93,155,199,0.2) !important;
    }

    .text-gray-600, .text-sm {
        color: #2c5a7a !important;
    }
</style>
    </head>
    
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
