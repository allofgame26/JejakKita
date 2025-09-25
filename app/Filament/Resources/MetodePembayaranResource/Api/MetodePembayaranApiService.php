<?php
namespace App\Filament\Resources\MetodePembayaranResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\MetodePembayaranResource;
use Illuminate\Routing\Router;


class MetodePembayaranApiService extends ApiService
{
    protected static string | null $resource = MetodePembayaranResource::class;

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
