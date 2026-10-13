@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
    <div class="max-w-4xl space-y-6">
        <!-- Title & Subtitle -->
        <div>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Profil & Pengaturan Akun
            </h1>
            <p class="text-xs text-[#7A5B49] mt-0.5">
                Kelola data profil pribadi Anda, alamat email, dan pembaruan kata sandi akun admin.
            </p>
        </div>

        <!-- Identity & Role Card -->
        <div class="bg-white p-6 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-[#6B2203] text-[#D4A574] flex items-center justify-center font-fraunces font-bold text-2xl uppercase shadow-warm-sm shrink-0 border-2 border-[#965E03]/30">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <h2 class="font-bold text-lg text-[#43281C]">{{ $user->name }}</h2>
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $user->role_badge_classes }}">
                            {{ $user->role_label }}
                        </span>
                    </div>
                    <p class="text-xs text-[#7A5B49] mt-0.5 font-medium">{{ $user->email }}</p>
                    <p class="text-[11px] text-[#7A5B49]/70 mt-1">ID Pengguna: #{{ $user->id }}</p>
                </div>
            </div>

            <!-- Activity & Login Meta -->
            <div class="bg-[#FAF7F2] p-4 rounded-[14px] border border-[#E8DEC8] text-xs space-y-1.5 self-stretch sm:self-auto min-w-[240px]">
                <div class="flex items-center justify-between gap-4">
                    <span class="text-[#7A5B49]">Terdaftar:</span>
                    <span class="font-semibold text-[#43281C]">{{ $user->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <span class="text-[#7A5B49]">Terakhir Login:</span>
                    <span class="font-semibold text-[#43281C]">
                        @if($user->last_login_at)
                            {{ $user->last_login_at->format('d M Y, H:i') }} WITA
                        @else
                            <span class="italic text-[#7A5B49]/60">Sesi saat ini</span>
                        @endif
                    </span>
                </div>
                @if($user->last_login_ip)
                    <div class="flex items-center justify-between gap-4">
                        <span class="text-[#7A5B49]">IP Login Terakhir:</span>
                        <span class="font-mono text-[11px] text-[#6B2203] font-semibold">{{ $user->last_login_ip }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Edit Profile Form -->
        <form action="{{ route('admin.profile.update') }}" method="POST" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Basic Info -->
            <div class="space-y-4">
                <h3 class="font-fraunces font-bold text-base text-[#6B2203] border-b border-[#E8DEC8] pb-2">
                    Informasi Akun
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                            Alamat Email (Login) <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1">
                        Peran Akses Sistem
                    </label>
                    <div class="px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs text-[#654A39] flex items-center justify-between">
                        <span class="font-semibold">{{ $user->role_label }}</span>
                        <span class="text-[11px] text-[#7A5B49] italic">Wewenang hak akses ditentukan oleh Super Administrator</span>
                    </div>
                </div>
            </div>

            <!-- Section 2: Security & Password Update -->
            <div class="space-y-4 pt-4 border-t border-[#E8DEC8]">
                <div>
                    <h3 class="font-fraunces font-bold text-base text-[#6B2203]">
                        Ganti Kata Sandi (Opsional)
                    </h3>
                    <p class="text-xs text-[#7A5B49] mt-0.5">
                        Biarkan kosong jika Anda tidak ingin memperbarui kata sandi. Jika ingin memperbarui, masukkan kata sandi saat ini untuk verifikasi keamanan.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="current_password" class="block text-[11px] font-bold text-[#6B2203] uppercase mb-1">
                            Kata Sandi Saat Ini
                        </label>
                        <input type="password" name="current_password" id="current_password" placeholder="Masukkan kata sandi lama" class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    </div>

                    <div>
                        <label for="password" class="block text-[11px] font-bold text-[#6B2203] uppercase mb-1">
                            Kata Sandi Baru
                        </label>
                        <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-[11px] font-bold text-[#6B2203] uppercase mb-1">
                            Konfirmasi Kata Sandi Baru
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi baru" class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-[#E8DEC8] flex items-center justify-between">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-bold shadow-warm-sm">
                    SIMPAN PERUBAHAN PROFIL
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-xs px-5 py-2">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
@endsection
