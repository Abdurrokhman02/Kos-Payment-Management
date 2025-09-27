<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse; // Tambahkan ini

class UserController extends Controller
{
    /**
     * Menampilkan daftar User (optional, tapi baiknya ada)
     */
    public function index()
    {
        // Untuk demo, kita asumsikan ini adalah halaman indeks daftar user
        $users = User::where('role', 'user')->get(); 
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk menambah User baru
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan data User baru
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi semua field, termasuk field tambahan dari migrasi Anda
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'], // Membatasi input jenis kelamin
            'nomor_kamar' => ['required', 'string', 'max:255'],
            'nomor_telepon' => ['required', 'string', 'max:255'],
            'alamat_asal' => ['required', 'string', 'max:255'],
            'nomor_darurat' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
            // Simpan semua field tambahan
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_kamar' => $request->nomor_kamar,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_asal' => $request->alamat_asal,
            'nomor_darurat' => $request->nomor_darurat,
            
            // Definisikan peran secara eksplisit
            'role' => 'user', 
        ]);

        // Arahkan ke halaman indeks user atau dashboard admin
        return redirect()->route('admin.users.index')->with('success', 'User ' . $user->name . ' berhasil ditambahkan.');
    }
}
