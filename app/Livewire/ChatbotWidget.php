<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChatbotWidget extends Component
{

    public $pesaninput = '';
    public $riwayatChat = []; //untuk memeorti percakapan History Aware

    public function kirimPesan()
    {
        // mencegah inputan kosong
        if (trim($this->pesaninput) === '') return;

        // menyimpan chat untuk di simpan di riwwayatChat
        $pertanyaan = $this->pesaninput;
        $this->riwayatChat[] = ['role' => 'user', 'content' => $pertanyaan];
        $this->pesaninput= ''; //mengkosongkan kolom input pesan setealh dikirim

        // mengambil riwayat lama untuk history Aware
        $historyUntukAPI = array_slice($this->riwayatChat, 0, -1);

        try {
            $response = Http::timeout(60)->post('http://127.0.0.1:8001/api/cari-jawaban',[
                'pertanyaan' => $pertanyaan,
                'jumlah_hasil' => 3, //kedepannya mungkin didalam embedding.py dirubah menjadi "tidak harus diisi"
                'history' => $ $historyUntukAPI
            ]);

            if ($response->successful()){
                $data = $response->json();
                // memasukkan jawaban ke layar Chatbot
                $this->riwayatChat[] = ['role' => 'assistant', 'content' => $data['jawaban_ai']];       
            } else {
                $this->riwayatChat[] = ['role' => 'assistant', 'content' => 'Maaf, terjadi kesalahan pada server AI'];
            }
        } catch (\Exception $e){
            $this->riwayatChat[] = ['role' => 'assistant', 'content' => 'Gagal terhubung ke server Python Lokal.'];
        }
    }

    public function render()
    {
        return view('livewire.chatbot-widget');
    }
}
