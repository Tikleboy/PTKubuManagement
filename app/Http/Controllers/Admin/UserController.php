<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = User::ROLES;
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => ['required', 'string', Rule::in(array_keys(User::ROLES))],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar sebagai akun admin lain.',
            'role.required' => 'Peran (Role) akun wajib dipilih.',
            'role.in' => 'Peran (Role) yang dipilih tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => strtolower(trim($validated['email'])),
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun administrator baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = User::ROLES;
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => ['nullable', 'string', Rule::in(array_keys(User::ROLES))],
            'password' => ['nullable', 'string', 'confirmed', Password::defaults()],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar untuk admin lain.',
            'role.in' => 'Peran (Role) yang dipilih tidak valid.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $newRole = $validated['role'] ?? $user->role;

        // Safety: If demoting self or another super admin, ensure at least one super admin remains
        if ($user->role === User::ROLE_SUPER_ADMIN && $newRole !== User::ROLE_SUPER_ADMIN) {
            $otherSuperAdminsCount = User::where('role', User::ROLE_SUPER_ADMIN)
                ->where('id', '!=', $user->id)
                ->count();
            if ($otherSuperAdminsCount === 0) {
                return back()->withErrors([
                    'role' => 'Tidak dapat mengubah peran akun ini. Sistem memerlukan minimal satu Super Administrator aktif.',
                ])->withInput();
            }
        }

        $user->name = $validated['name'];
        $user->email = strtolower(trim($validated['email']));
        $user->role = $newRole;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun administrator berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Prevent deleting own currently active account
        if ($user->id === auth()->id()) {
            return back()->withErrors([
                'error' => 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.',
            ]);
        }

        // Prevent deleting the last remaining admin
        if (User::count() <= 1) {
            return back()->withErrors([
                'error' => 'Tidak dapat menghapus akun. Harus ada minimal 1 akun administrator aktif di sistem.',
            ]);
        }

        // Prevent deleting the last remaining Super Admin
        if ($user->role === User::ROLE_SUPER_ADMIN) {
            $otherSuperAdminsCount = User::where('role', User::ROLE_SUPER_ADMIN)
                ->where('id', '!=', $user->id)
                ->count();
            if ($otherSuperAdminsCount === 0) {
                return back()->withErrors([
                    'error' => 'Tidak dapat menghapus akun ini. Harus ada minimal satu Super Administrator aktif di sistem.',
                ]);
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun administrator berhasil dihapus.');
    }
}
