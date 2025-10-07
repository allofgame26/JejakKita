<?php
namespace App\Filament\Resources\TransaksiDonasiProgramResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\TransaksiDonasiProgramResource;
use Illuminate\Routing\Router;


class TransaksiDonasiProgramApiService extends ApiService
{
    protected static string | null $resource = TransaksiDonasiProgramResource::class;

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
