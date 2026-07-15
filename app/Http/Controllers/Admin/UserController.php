<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $permissionsList = [
            'hotels' => 'Oteller (Hotels)',
            'restaurants' => 'Restoranlar (Restaurants)',
            'yachts' => 'Yatlar (Yachts)',
            'guides' => 'Gezi Rehberi (Travel Guide)',
            'events' => 'Etkinlikler (Events)',
            'journals' => 'Journal',
            'settings' => 'Genel Ayarlar (Settings)',
            'users' => 'Kullanıcı Yönetimi (User Management)',
            'destinations' => 'Anasayfa Destinasyonları (Destinations)'
        ];

        return view('admin.users.create', compact('permissionsList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:super_admin,editor',
            'permissions' => 'nullable|array',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'permissions' => $request->input('permissions') ?? [],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }

    public function edit(User $user)
    {
        $permissionsList = [
            'hotels' => 'Oteller (Hotels)',
            'restaurants' => 'Restoranlar (Restaurants)',
            'yachts' => 'Yatlar (Yachts)',
            'guides' => 'Gezi Rehberi (Travel Guide)',
            'events' => 'Etkinlikler (Events)',
            'journals' => 'Journal',
            'settings' => 'Genel Ayarlar (Settings)',
            'users' => 'Kullanıcı Yönetimi (User Management)',
            'destinations' => 'Anasayfa Destinasyonları (Destinations)'
        ];

        return view('admin.users.edit', compact('user', 'permissionsList'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|string|in:super_admin,editor',
            'permissions' => 'nullable|array',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'permissions' => $request->input('permissions') ?? [],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function destroy(User $user)
    {
        if ($user->email === 'admin@dioreal.com') {
            return redirect()->route('admin.users.index')->withErrors(['delete_error' => 'Birincil yönetici kullanıcısı silinemez.']);
        }

        if (auth()->check() && auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->withErrors(['delete_error' => 'Kendi kullanıcınızı silemezsiniz.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }
}
