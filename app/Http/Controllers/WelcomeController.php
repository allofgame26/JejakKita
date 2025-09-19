<?php

namespace App\Http\Controllers;

use App\Models\m_kategori;
use App\Policies\m_kategoriPolicy;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $semuaKategori = m_kategori::has('posts')->with('posts.media')->orderBy('row','asc')->get();

        return view('welcomes', [
            'daftarKategori' => $semuaKategori,
        ]);
    }
}
