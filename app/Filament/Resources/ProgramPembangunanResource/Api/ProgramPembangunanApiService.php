<?php
namespace App\Filament\Resources\ProgramPembangunanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ProgramPembangunanResource;
use Illuminate\Routing\Router;


class ProgramPembangunanApiService extends ApiService
{
    protected static string | null $resource = ProgramPembangunanResource::class;

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
