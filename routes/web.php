<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use Illuminate\Support\Facades\DB;

Route::get('/acara17', function () {
    // ---------------------------------------------------
    // POIN 3: Memperbarui Data (Update)
    // ---------------------------------------------------
    DB::table('users')
        ->where('email', 'mahasiswajti@example.com')
        ->update(['name' => 'Mahasiswa JTI Updated']);

    // ---------------------------------------------------
    // POIN 5: Mengambil Daftar Nilai Kolom (Pluck)
    // ---------------------------------------------------
    $names = DB::table('users')->pluck('name');

    // ---------------------------------------------------
    // POIN 6: Agregat (Menghitung jumlah data)
    // ---------------------------------------------------
    $totalUsers = DB::table('users')->count();

    // ---------------------------------------------------
    // POIN 8: Pengurutan dan Limit (Order By & Limit)
    // ---------------------------------------------------
    $orderedUsers = DB::table('users')->orderBy('name', 'desc')->limit(5)->get();

    // ---------------------------------------------------
    // POIN 10: Query Raw
    // ---------------------------------------------------
    $rawQuery = DB::table('users')->selectRaw('COUNT(*) as total_users')->get();

    $hasilTampilan = [
        'status_update' => 'Berhasil memperbarui nama',
        'hasil_poin_5_pluck' => $names,
        'hasil_poin_6_agregat_count' => $totalUsers,
        'hasil_poin_8_order_limit' => $orderedUsers,
        'hasil_poin_10_raw' => $rawQuery
    ];

    dd($hasilTampilan);
});
use App\Http\Controllers\FormController;

// Menampilkan form saat mengakses link /form
Route::get('/form', [FormController::class, 'index']);

// Menangani pengiriman data saat tombol submit diklik
Route::post('/submit', [FormController::class, 'submitForm']);

use App\Models\User;
use Illuminate\Support\Str;

Route::get('/acara18', function () {
    // Menambahkan Data (Create)
    $emailBaru = 'mahasiswa18_' . Str::random(4) . '@example.com';
    $userBaru = User::create([
        'name' => 'John Doe Acara 18',
        'email' => $emailBaru,
        'password' => bcrypt('password')
    ]);

    // Mengambil & Memperbarui Data (Retrieve & Update)
    $userDiambil = User::where('email', $emailBaru)->firstOrFail();
    $userDiambil->name = 'John Doe Updated';
    $userDiambil->save();

    // Mengambil semua data untuk tabel
    $semuaUser = User::all();

    // Mengirim data ke file tampil_acara18.blade.php
    return view('tampil_acara18', compact('semuaUser', 'userDiambil'));
});

Route::get('/acara19', function () {
    $userActive = User::where('name', 'LIKE', '%John%')->get();
    $userOr = User::where('id', 1)->orWhere('email', 'LIKE', '%example.com%')->get();
    $userIn = User::whereIn('id', [1, 2, 3])->get();
    $userNotNull = User::whereNotNull('email')->get();

    return view('tampil_acara19', compact('userActive', 'userOr', 'userIn', 'userNotNull'));
});