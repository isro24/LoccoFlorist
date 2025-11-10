<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth/login.js'])
</head>
<body class="bg-loginBg font-sans">

<div class="flex justify-center items-center min-h-screen p-3">
    <div class="w-full max-w-[600px]">
        <div class="text-center mb-4">
            <h4 class="text-[#d7a6c3] text-lg">Welcome to</h4>
            <h2 class="text-textPink font-[Playfair Display] tracking-[1.5px] text-3xl">Locco Florist!</h2>
        </div>

        <div class="font-medium mb-3 md:ml-12 text-xl md:text-2xl text-[#343a40]">Sign in</div>

        <div class="bg-[#ffeef8] rounded-[20px] shadow-sm p-6 md:p-10">
            <form id="loginForm" action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <div class="mb-4">
                    <input 
                        type="email"
                        name="email"
                        id="emailInput"
                        placeholder="Email"
                        autocomplete="off"
                        class="w-full rounded-xl bg-[#cfcfcf] px-6 py-4 text-[#343a40] placeholder-white text-lg focus:outline-none"
                    >
                    <div class="text-red-700 text-sm mt-1 min-h-[1.2em]" id="emailError"></div>
                </div>

                <div class="mb-4 relative">
                    <input
                        type="password"
                        name="password"
                        id="passwordInput"
                        placeholder="Password"
                        class="w-full rounded-xl bg-[#cfcfcf] px-6 py-4 pr-14 text-[#343a40] placeholder-white text-lg focus:outline-none"
                    >
                    <i id="togglePasswordIcon"
                       class="bi bi-eye absolute right-5 top-1/3 transform -translate-y-1/2 text-[#6c757d] text-xl cursor-pointer">
                    </i>
                    <div class="text-red-700 text-sm mt-1 min-h-[1.2em]" id="passwordError"></div>
                </div>

                @if ($errors->any())
                    <div class="auto-dismiss-alert bg-[#f8d7da] text-[#721c24] border border-[#f5c6cb] rounded p-3 mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-xl mr-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                @if (session('error'))
                    <div class="auto-dismiss-alert bg-[#f8d7da] text-[#721c24] border border-[#f5c6cb] rounded p-3 mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-xl mr-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="auto-dismiss-alert bg-green-200 text-green-800 rounded p-3 mb-3">
                        <i class="bi bi-check-circle-fill text-xl mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <button type="submit" 
                        class="w-full bg-[#ff79b0] text-white rounded-xl py-4 text-lg font-bold transition-all duration-200 hover:shadow-lg hover:-translate-y-1 cursor-pointer">
                    Login
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
