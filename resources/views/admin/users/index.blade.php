@extends('layouts.admin')

@section('title', 'Kelola Akun Admin')

@section('content')
    <div class="space-y-6">
        <!-- Top Title & Action Button -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                    Kelola Akun Administrator
                </h1>
                <p class="text-xs text-[#7A5B49] mt-0.5">
                    Daftar akun admin yang memiliki hak akses untuk mengelola seluruh konten website.
                </p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-primary text-xs px-5 py-2.5 flex items-center justify-center gap-2 self-start sm:self-auto shadow-warm-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                <span>Tambah Admin Baru</span>
            </a>
        </div>

        <!-- Admins Table Card -->
        <div class="bg-white rounded-[20px] border border-[#E8DEC8] shadow-warm-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF7F2] text-[#6B2203] uppercase tracking-wider border-b border-[#E8DEC8]">
                        <tr>
                            <th class="p-4">Nama Administrator</th>
                            <th class="p-4">Email Login</th>
                            <th class="p-4">Peran (Role)</th>
                            <th class="p-4">Terakhir Login</th>
                            <th class="p-4">Terdaftar</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E8DEC8]">
                        @forelse($users as $user)
                            <tr class="hover:bg-[#FAF7F2]/50 transition-colors {{ $user->id === auth()->id() ? 'bg-[#FAF7F2]/30' : '' }}">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-[#6B2203] text-[#D4A574] flex items-center justify-center font-bold text-xs uppercase shadow-xs shrink-0">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-sm text-[#43281C] flex items-center gap-2">
                                                <span>{{ $user->name }}</span>
                                                @if($user->id === auth()->id())
                                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#2D6A4F]/10 text-[#2D6A4F] border border-[#2D6A4F]/20">
                                                        Akun Anda
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="text-[11px] text-[#7A5B49]">ID: #{{ $user->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-[#43281C] font-medium">
                                    {{ $user->email }}
                                </td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $user->role_badge_classes }}">
                                        {{ $user->role_label }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($user->last_login_at)
                                        <div class="font-medium text-[#43281C]">{{ $user->last_login_at->diffForHumans() }}</div>
                                        <div class="text-[11px] text-[#7A5B49]">{{ $user->last_login_at->format('d M Y, H:i') }} WITA</div>
                                        @if($user->last_login_ip)
                                            <div class="font-mono text-[10px] text-[#7A5B49]/70 mt-0.5">IP: {{ $user->last_login_ip }}</div>
                                        @endif
                                    @else
                                        <span class="text-[#7A5B49]/60 italic">Belum pernah login</span>
                                    @endif
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="p-4 text-right space-x-2 whitespace-nowrap">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="font-bold text-[#965E03] hover:underline inline-flex items-center gap-1">
                                        <span>Edit</span>
                                    </a>

                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline confirm-delete-form" data-title="Hapus Akun Admin?" data-message="Apakah kamu yakin ingin menghapus akun admin &quot;{{ $user->name }}&quot;? Tindakan ini tidak dapat dibatalkan.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-bold text-red-600 hover:underline inline-flex items-center gap-1 ml-2">
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[#7A5B49]/50 italic text-[11px] ml-2" title="Anda tidak dapat menghapus akun Anda sendiri">(Aktif)</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-[#7A5B49]">
                                    Belum ada akun administrator tambahan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="p-4 border-t border-[#E8DEC8]">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

        <!-- Role Permissions Guide Card -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="p-4 rounded-[14px] bg-white border border-[#E8DEC8] shadow-warm-sm space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#6B2203]"></span>
                    <h4 class="font-bold text-xs text-[#6B2203]">Super Admin</h4>
                </div>
                <p class="text-[11px] text-[#7A5B49]">Akses penuh ke seluruh menu sistem, pengelolaan profil PT, pengaturan WhatsApp, dan hak mengelola akun admin lain.</p>
            </div>

            <div class="p-4 rounded-[14px] bg-white border border-[#E8DEC8] shadow-warm-sm space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                    <h4 class="font-bold text-xs text-blue-900">Content Editor</h4>
                </div>
                <p class="text-[11px] text-[#7A5B49]">Dapat menambah, mengubah, dan mempublikasikan data Layanan, Portofolio Project, dan Galeri Foto.</p>
            </div>

            <div class="p-4 rounded-[14px] bg-white border border-[#E8DEC8] shadow-warm-sm space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                    <h4 class="font-bold text-xs text-emerald-900">HR / Rekrutmen</h4>
                </div>
                <p class="text-[11px] text-[#7A5B49]">Fokus pada manajemen lowongan kerja (Loker / Karir), menambah posisi baru, dan status publikasi rekrutmen.</p>
            </div>

            <div class="p-4 rounded-[14px] bg-white border border-[#E8DEC8] shadow-warm-sm space-y-1.5">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-amber-600"></span>
                    <h4 class="font-bold text-xs text-amber-900">Customer Service</h4>
                </div>
                <p class="text-[11px] text-[#7A5B49]">Melihat pesan masuk (inquiries), follow-up permintaan layanan dari calon klien, dan mengubah status tindak lanjut.</p>
            </div>
        </div>
    </div>
@endsection
