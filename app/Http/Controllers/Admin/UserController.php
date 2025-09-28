<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 1. Definisikan semua kamar yang ada
        $semuaKamar = ['A1', 'A2', 'A3', 'B1', 'B2', 'B3'];

        // 2. Ambil semua kamar yang sudah terisi
        $kamarTerisi = User::where('role', 'user')->pluck('nomor_kamar')->toArray();

        // 3. Cari kamar yang kosong dengan membandingkan dua array
        $kamarKosong = array_diff($semuaKamar, $kamarTerisi);

        // 4. Kirim data kamar kosong ke view
        return view('admin.users.create', compact('kamarKosong'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nomor_kamar' => ['required', 'string'],
            'nomor_telepon' => ['required', 'string'],
            'alamat_asal' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'nomor_darurat' => ['required', 'string'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Otomatis set role sebagai 'user'
            'nomor_kamar' => $request->nomor_kamar,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_asal' => $request->alamat_asal,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_darurat' => $request->nomor_darurat,
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        // Pastikan tidak menghapus admin lain atau diri sendiri (opsional tapi aman)
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Admin tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Penghuni berhasil dihapus.');
    }
}