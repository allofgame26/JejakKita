<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request){
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Cari user berdasarkan email
    $user = User::where('email', $request->email)->first();

    // Periksa apakah user ada dan passwordnya cocok
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Email atau password salah.'
        ], 401); // 401 Unauthorized
    }

    // Hapus token lama untuk mencegah penumpukan
    $user->tokens()->delete();

    // Buat token baru
    $token = $user->createToken('api-token')->plainTextToken;

    // Kembalikan respons berisi token
    return response()->json([
        'message' => 'Login berhasil',
        'user' => $user,
        'token' => $token,
    ]);
});