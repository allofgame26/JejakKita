<?php
namespace App\Filament\Resources\KategooriPostResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KategooriPostResource;
use App\Models\m_kategori_post;
use Illuminate\Routing\Router;


class KategooriPostApiService extends ApiService
{
    protected static string | null $resource = m_kategori_post::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];
        
    }
}
