<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin PT. KUBU MANAGEMENT BALI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;500;600;700&family=Fraunces:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Albert Sans', sans-serif; }
        .font-fraunces { font-family: 'Fraunces', serif; }
    </style>
</head>
<body class="bg-[#F5F1E8] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-[28px] border border-[#E8DEC8] p-8 sm:p-10 shadow-warm-lg space-y-6">
        <div class="text-center space-y-2">
            <div class="w-14 h-14 rounded-[14px] bg-[#965E03] text-white flex items-center justify-center font-fraunces font-bold text-2xl mx-auto shadow-warm-sm">
                K
            </div>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                KUBU MANAGEMENT BALI
            </h1>
            <p class="label-caps text-[#965E03] text-[11px] font-bold">ADMIN DHASBOARD</p>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-[12px] bg-red-50 border border-red-200 text-red-700 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1">
                    Username
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', 'admin@kubumanagementbali.com') }}" required autofocus class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03]">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1">
                    Password
                </label>
                <input type="password" name="password" id="password" value="admin12345" required class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03]">
            </div>

            <div class="flex items-center justify-between text-xs text-[#7A5B49]">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-[#965E03] focus:ring-0">
                    <span>Ingat Username</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-primary w-full py-3.5 text-center font-bold text-sm">
                    MASUK
                </button>
            </div>
        </form>

        <div class="pt-4 border-t border-[#E8DEC8] text-center">
            <a href="{{ route('home') }}" class="text-xs text-[#965E03] hover:underline">
                ← Kembali ke Website Utama
            </a>
        </div>
    </div>
</body>
</html>
