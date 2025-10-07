<?php
namespace App\Filament\Resources\TransaksiDonasiSpesifikResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\TransaksiDonasiSpesifikResource;
use Illuminate\Routing\Router;


class TransaksiDonasiSpesifikApiService extends ApiService
{
    protected static string | null $resource = TransaksiDonasiSpesifikResource::class;

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
