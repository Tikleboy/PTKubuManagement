@extends('layouts.admin')

@section('title', 'Tambah Admin Baru')

@section('content')
    <div class="max-w-2xl space-y-6">
        <div>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                ← Kembali ke Daftar Admin
            </a>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Tambah Akun Administrator Baru
            </h1>
            <p class="text-xs text-[#7A5B49] mt-0.5">
                Tambahkan akun admin baru untuk membagi tugas manajemen konten website.
            </p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: I Wayan Suardika" class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
            </div>

            <div>
                <label for="email" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Alamat Email (Untuk Login) <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="nama@kubumanagementbali.com" class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                <p class="text-[11px] text-[#7A5B49] mt-1">Gunakan alamat email aktif yang belum pernah terdaftar sebelumnya.</p>
            </div>

            <div>
                <label for="role" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Peran & Hak Akses (Role) <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role" required class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih peran akses...</option>
                    @foreach($roles as $key => $label)
                        <option value="{{ $key }}" {{ old('role') === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <p class="text-[11px] text-[#7A5B49] mt-1">
                    Sesuaikan hak akses sesuai pembagian kerja: Super Admin, Editor Layanan/Portfolio, HR Loker, atau CS Pesan Masuk.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                        Kata Sandi (Password) <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter" class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                        Konfirmasi Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi kata sandi" class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                </div>
            </div>

            <div class="p-3.5 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-[11px] text-[#654A39] space-y-1">
                <span class="font-bold text-[#6B2203] block">🛡️ Ketentuan Hak Akses & Keamanan:</span>
                <p>Akun administrator baru akan memiliki akses penuh ke seluruh menu Admin CMS. Pastikan memberikan kredensial hanya kepada pengelola website atau staf internal yang berwenang.</p>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8] flex items-center justify-between">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-bold shadow-warm-sm">
                    SIMPAN AKUN ADMIN
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary text-xs px-5 py-2">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
