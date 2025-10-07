<?php
namespace App\Filament\Resources\KategooriPostResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KategooriPostResource;
use Illuminate\Routing\Router;


class KategooriPostApiService extends ApiService
{
    protected static string | null $resource = KategooriPostResource::class;

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
