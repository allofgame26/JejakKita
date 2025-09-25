<?php
namespace App\Filament\Resources\DataDiriResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\DataDiriResource;
use Illuminate\Routing\Router;


class DataDiriApiService extends ApiService
{
    protected static string | null $resource = DataDiriResource::class;

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
