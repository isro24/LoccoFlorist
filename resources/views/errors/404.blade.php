<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found • 404</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="m-0 p-0 bg-[#faf9fb] font-serif flex items-center justify-center min-h-screen text-[#2d2d2d]">
    <div class="bg-white rounded-2xl shadow-xl w-[90%] max-w-[420px] px-10 py-12 text-center">

        <h1 class="font-bold text-8xl text-[#ff4d94] drop-shadow-lg">404</h1>

        <p class="mt-6 text-xl opacity-70 leading-relaxed">
            Oops! Halaman yang kamu cari tidak ditemukan.
        </p>

        <a href="{{ url('/') }}"
           class="inline-block mt-10 py-3 px-6 bg-pinkBg rounded-xl text-white font-semibold text-lg shadow-lg hover:shadow-md hover:opacity-90 transition-all">
            Kembali ke Beranda
        </a>
        
    </div>
</body>
</html>