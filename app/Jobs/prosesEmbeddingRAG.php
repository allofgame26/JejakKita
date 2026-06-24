<?php

namespace App\Jobs;

use App\Models\dokumen_rag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class prosesEmbeddingRAG implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $document;

    /**
     * Create a new job instance.
     */
    public function __construct(dokumen_rag $document)
    {
        $this->document = $document;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $urlPythonAPI = 'http://127.0.0.1:8001/api/embed-dokumen';

        $response = Http::post($urlPythonAPI, [
            'dokumen_id' => $this->document->id,
            'dokumen_path' => storage_path('app/public/' . $this->document->file_path),
        ]);

        if ($response->failed()){
            $this->fail(new \Exception('Gagal terhubung dengan API Python'));
        }
    }
}
