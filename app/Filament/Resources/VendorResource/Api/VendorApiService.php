<?php
namespace App\Filament\Resources\VendorResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\VendorResource;
use Illuminate\Routing\Router;


class VendorApiService extends ApiService
{
    protected static string | null $resource = VendorResource::class;

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
