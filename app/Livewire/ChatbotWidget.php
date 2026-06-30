<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChatbotWidget extends Component
{

    public $pesanInput = '';
    public $riwayatChat = []; //untuk memeorti percakapan History Aware

    public function kirimPesan()
    {
        // mencegah inputan kosong
        if (trim($this->pesanInput) === '') return;

        // menyimpan chat untuk di simpan di riwwayatChat
        $pertanyaan = $this->pesanInput;
        $this->riwayatChat[] = ['role' => 'user', 'content' => $pertanyaan];
        $this->pesanInput= ''; //mengkosongkan kolom input pesan setealh dikirim

        // mengambil riwayat lama untuk history Aware
        $historyUntukAPI = array_slice($this->riwayatChat, 0, -1);

        try {
            $response = Http::timeout(300)->post('http://127.0.0.1:8001/api/pertanyaan',[
                'pertanyaan' => $pertanyaan,
                'jumlah_hasil' => 2, //kedepannya mungkin didalam embedding.py dirubah menjadi "tidak harus diisi"
                'history' => $historyUntukAPI
            ]);

            if ($response->successful()){
                $data = $response->json();
                // memasukkan jawaban ke layar Chatbot
                $this->riwayatChat[] = ['role' => 'assistant', 'content' => $data['jawaban_ai']];
                
                // Rangkaian metrics untuk menampilkan dibawah chat AI
                $stringMetrics = "Waktu: {data['waktu_proses']} dt| Jarak Consine: {data['jarak_vector']}";

                $this->riwayatChat[] = [
                    'role' => 'assistant',
                    'content' => $data['jawaban_ai'],
                    'metrics' => $stringMetrics // memasukkan metrik ke memori
                ];
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
