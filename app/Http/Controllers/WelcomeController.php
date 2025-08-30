<?php

namespace App\Http\Controllers;

use App\Models\m_kategori;
use App\Policies\m_kategoriPolicy;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $kategoriPembangunan = m_kategori::with('posts.media')
            ->where('title','like','pembangunan%')->get();
        $kategoriGaleri = m_kategori::with('posts.media')
            ->where('title','like','galerisekolah%')->get();

        return view('welcomes', [
            'dataPembangunan' => $kategoriPembangunan,
            'dataGaleri' => $kategoriGaleri
        ]);
    }
}
