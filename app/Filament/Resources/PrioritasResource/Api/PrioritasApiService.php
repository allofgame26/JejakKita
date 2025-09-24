<?php
namespace App\Filament\Resources\PrioritasResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PrioritasResource;
use Illuminate\Routing\Router;


class PrioritasApiService extends ApiService
{
    protected static string | null $resource = PrioritasResource::class;

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
