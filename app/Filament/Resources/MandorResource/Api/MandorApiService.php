<?php
namespace App\Filament\Resources\MandorResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\MandorResource;
use Illuminate\Routing\Router;


class MandorApiService extends ApiService
{
    protected static string | null $resource = MandorResource::class;

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
