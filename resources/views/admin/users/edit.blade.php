@extends('layouts.admin')

@section('title', 'Edit Akun Admin')

@section('content')
    <div class="max-w-2xl space-y-6">
        <div>
            <a href="{{ route('admin.users.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                ← Kembali ke Daftar Admin
            </a>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Edit Akun Administrator
            </h1>
            <p class="text-xs text-[#7A5B49] mt-0.5">
                Perbarui data profil atau atur ulang kata sandi administrator.
            </p>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
            </div>

            <div>
                <label for="email" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Alamat Email (Untuk Login) <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
            </div>

            <div>
                <label for="role" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                    Peran & Hak Akses (Role) <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role" required class="w-full px-3.5 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    @foreach($roles as $key => $label)
                        <option value="{{ $key }}" {{ old('role', $user->role) === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @if($user->id === auth()->id())
                    <p class="text-[11px] text-[#965E03] mt-1 font-medium">
                        Catatan: Ini adalah akun Anda sendiri. Pastikan selalu ada minimal satu Super Administrator aktif di sistem.
                    </p>
                @endif
            </div>

            <div class="p-4 rounded-[14px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-4">
                <div>
                    <span class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider">
                        Ubah Kata Sandi (Opsional)
                    </span>
                    <p class="text-[11px] text-[#7A5B49] mt-0.5">
                        Biarkan kedua bidang di bawah ini kosong jika Anda tidak ingin mengubah kata sandi akun ini.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-[11px] font-bold text-[#6B2203] uppercase mb-1">
                            Kata Sandi Baru
                        </label>
                        <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" class="w-full px-3.5 py-2.5 rounded-[10px] bg-white border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-[11px] font-bold text-[#6B2203] uppercase mb-1">
                            Konfirmasi Kata Sandi Baru
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi baru" class="w-full px-3.5 py-2.5 rounded-[10px] bg-white border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8] flex items-center justify-between">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5 font-bold shadow-warm-sm">
                    PERBARUI AKUN ADMIN
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-secondary text-xs px-5 py-2">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
