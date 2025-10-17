<?php

use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WelcomeController;
use App\Models\m_post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::get('preview/post/{post}', function (m_post $post){
    $kategori = $post->kategori()->first();

    $dataPembangunan = collect();
    $dataGaleri = collect();

    if($kategori){
        if (str_starts_with($kategori->title, 'pembangunan')){
            $dataPembangunan = collect([$kategori]);
        } elseif (str_starts_with($kategori->title, 'galerisekolah')) {
            $dataGaleri = collect([$kategori]);
        }
    }

    return view('welcomes' ,[
        'dataPembangunan' => $dataPembangunan,
        'dataGaleri' => $dataGaleri,
    ]);  
})->name('post.preview');

Route::get('/transaksi/{transaksi}/download-kwitansi', [KwitansiController::class, 'downloadProgram'])
    ->name('kwitansiProgram.download')
    ->middleware('auth');

Route::get('/transaksi-spesifikasi/{transaksi}/download-kwitansi', [KwitansiController::class, 'downloadSpesifikasi'])
    ->name('kwitansiSpesifikasi.download')
    ->middleware('auth');

Route::get('/download-history-transaksi',[PdfController::class, 'downloadHistoryTransaksi'])->name('download.history.transaksi');

// laporan bulanan dan custom date range untuk Web Profile

Route::get('/laporan/download-rage', [ReportController::class, 'reportDateRange'])->name('report.date.range.download');

Route::get('/laporan/download-realtime', [ReportController::class, 'downloadRealtime'])->name('laporan.download.realtime');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
