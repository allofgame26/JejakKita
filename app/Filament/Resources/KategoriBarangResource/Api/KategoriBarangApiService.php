<?php
namespace App\Filament\Resources\KategoriBarangResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KategoriBarangResource;
use Illuminate\Routing\Router;


class KategoriBarangApiService extends ApiService
{
    protected static string | null $resource = KategoriBarangResource::class;

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
