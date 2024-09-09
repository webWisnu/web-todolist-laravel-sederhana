<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @notifyCss
     <style>
           .notify {
    color: white; /* Warna teks */
    padding: 20px 30px; /* Perbesar padding */
    border-radius: 10px; /* Lebih melengkungkan sudut */
    font-size: 1.2rem; /* Ukuran teks lebih besar */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Perbesar bayangan */


    }
        </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script>
        function toggleEdit(button) {
            // Cari elemen list-group-item yang mengandung tombol pensil yang di-klik
            const parentItem = button.closest('li');

            // Temukan elemen berikutnya yang merupakan form update
            const updateItem = parentItem.nextElementSibling;

            // Toggle visibilitas dari form update
            if (updateItem.style.display === 'none' || updateItem.style.display === '') {
                updateItem.style.display = 'block';
            } else {
                updateItem.style.display = 'none';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
