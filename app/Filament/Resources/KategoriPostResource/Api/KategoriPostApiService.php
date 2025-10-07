<?php
namespace App\Filament\Resources\KategoriPostResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KategoriPostResource;
use Illuminate\Routing\Router;


class KategoriPostApiService extends ApiService
{
    protected static string | null $resource = KategoriPostResource::class;

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
