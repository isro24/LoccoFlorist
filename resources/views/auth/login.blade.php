<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth/login.js'])
    @stack('styles')
</head>

<body class="bg-linear-to-br from-pink-50 to-rose-100 font-sans min-h-screen flex justify-center items-center p-4 relative">

    <div class="absolute top-10 left-10 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>

    <div class="relative w-full max-w-md z-10">
        
        <div class="text-center mb-8">
            <div class="inline-block bg-white/80 backdrop-blur-sm px-4 py-1.5 rounded-full text-sm text-pink-600 font-medium mb-3 shadow-sm">
                Welcome to Locco Florist
            </div>
            <h2 class="text-3xl font-bold font-serif text-gray-800 mb-2">
                Sign In
            </h2>
        </div>

        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl border border-white/60 p-8">

            <form id="loginForm" action="{{ route('admin.login') }}" method="POST" novalidate>
                @csrf

                <div class="space-y-5">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <i class="bi bi-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input 
                                type="email"
                                name="email"
                                id="emailInput"
                                placeholder="Masukkan email Anda"
                                autocomplete="off"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400 
                                       focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent 
                                       transition-all"
                            />
                        </div>
                        <div class="text-red-600 text-sm mt-1 min-h-[1.2em]" id="emailError"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <i class="bi bi-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input
                                type="password"
                                name="password"
                                id="passwordInput"
                                placeholder="Masukkan password Anda "
                                class="w-full pl-11 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-800 placeholder-gray-400
                                       focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent 
                                       transition-all"
                            />
                            <i id="togglePasswordIcon"
                               class="bi bi-eye absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer hover:text-pink-500 transition-colors"></i>
                        </div>
                        <div class="text-red-600 text-sm mt-1 min-h-[1.2em]" id="passwordError"></div>
                    </div>

                    @if ($errors->any())
                        <div class="auto-dismiss-alert bg-red-50 border border-red-200 text-red-700 rounded-lg p-3 flex items-center gap-2">
                            <i class="bi bi-exclamation-circle text-lg shrink-0"></i>
                            <div class="text-sm">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="auto-dismiss-alert bg-red-50 border border-red-200 text-red-700 rounded-lg p-3 flex items-center gap-2">
                            <i class="bi bi-exclamation-circle text-lg shrink-0"></i>
                            <span class="text-sm">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="auto-dismiss-alert bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg p-3 flex items-center gap-2">
                            <i class="bi bi-check-circle text-lg shrink-0"></i>
                            <span class="text-sm">{{ session('success') }}</span>
                        </div>
                    @endif

                    <button type="submit" 
                            class="w-full bg-linear-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 
                                   text-white font-semibold rounded-lg py-3 mt-2
                                   shadow-md hover:shadow-lg
                                   transition-all duration-200 
                                   focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2 cursor-pointer">
                        Login
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-xs text-gray-500 mt-6">
            © 2025 Locco Florist. All rights reserved.
        </p>
    </div>

</body>
</html>