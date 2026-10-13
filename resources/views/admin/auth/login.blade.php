<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | PT. KUBU MANAGEMENT BALI</title>
    <!-- Favicon & Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;500;600;700&family=Fraunces:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Albert Sans', sans-serif; }
        .font-fraunces { font-family: 'Fraunces', serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#F5F1E8] via-[#FAF7F2] to-[#ECE5D8] min-h-screen flex items-center justify-center p-4 selection:bg-[#D4A574]/30 selection:text-[#6B2203]">
    <div class="max-w-md w-full bg-white rounded-[28px] border border-[#E8DEC8] p-8 sm:p-10 shadow-warm-lg space-y-6">
        <!-- Header & Logo Section -->
        <div class="text-center space-y-3">
            <a href="{{ route('home') }}" class="inline-block transition-transform duration-300 hover:scale-[1.02] focus:outline-none" title="Menuju ke Website Utama PT. Kubu Management Bali">
                <img src="{{ asset('images/kubu/logo.png') }}" 
                     alt="PT. KUBU MANAGEMENT BALI" 
                     width="240"
                     height="95"
                     class="h-16 sm:h-20 w-auto max-w-[240px] sm:max-w-[270px] mx-auto object-contain drop-shadow-xs" 
                     style="max-height: 80px; width: auto; display: block;">
            </a>
            <div>
                <h1 class="font-fraunces text-xl sm:text-2xl font-bold text-[#6B2203] tracking-wide">
                    Admin Dashboard
                </h1>
            </div>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-[12px] bg-red-50 border border-red-200 text-red-700 text-xs flex items-start gap-2.5">
                <svg class="w-4 h-4 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Username / Email <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}" 
                           autocomplete="username"
                           required 
                           autofocus 
                           placeholder="nama@kubumanagementbali.com" 
                           class="w-full pl-4 pr-10 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm text-[#43281C] placeholder-[#7A5B49]/50 focus:outline-none focus:border-[#965E03] focus:ring-2 focus:ring-[#965E03]/15 transition-all">
                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-[#965E03]/60">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                    </div>
                </div>
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Password <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <input type="password" 
                           name="password" 
                           id="password" 
                           autocomplete="current-password"
                           required 
                           placeholder="••••••••" 
                           class="w-full pl-4 pr-11 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm text-[#43281C] placeholder-[#7A5B49]/50 focus:outline-none focus:border-[#965E03] focus:ring-2 focus:ring-[#965E03]/15 transition-all">
                    <button type="button" 
                            id="togglePassword" 
                            tabindex="-1"
                            title="Tampilkan / Sembunyikan Password"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-[#7A5B49] hover:text-[#965E03] transition-colors focus:outline-none">
                        <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="eyeSlashIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs text-[#7A5B49] pt-1">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#965E03] border-[#E8DEC8] focus:ring-0 accent-[#965E03]">
                    <span>Ingat Saya di Perangkat Ini</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-primary w-full py-3.5 text-center font-bold text-sm tracking-wide shadow-warm-md hover:shadow-warm-lg transition-all">
                    Masuk
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-[#E8DEC8] text-center">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-[#965E03] hover:text-[#6B2203] hover:underline transition-colors inline-flex items-center gap-1.5">
                <span>← Kembali ke Halaman Website</span>
            </a>
        </div>
    </div>

    <!-- Password visibility toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (toggleBtn && passwordInput) {
                toggleBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    eyeIcon.classList.toggle('hidden', isPassword);
                    eyeSlashIcon.classList.toggle('hidden', !isPassword);
                });
            }
        });
    </script>
</body>
</html>

