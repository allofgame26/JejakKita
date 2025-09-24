<?php
namespace App\Filament\Resources\PeriodeResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PeriodeResource;
use Illuminate\Routing\Router;


class PeriodeApiService extends ApiService
{
    protected static string | null $resource = PeriodeResource::class;

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
