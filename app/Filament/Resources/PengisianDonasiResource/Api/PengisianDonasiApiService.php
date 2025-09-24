<?php
namespace App\Filament\Resources\PengisianDonasiResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PengisianDonasiResource;
use Illuminate\Routing\Router;


class PengisianDonasiApiService extends ApiService
{
    protected static string | null $resource = PengisianDonasiResource::class;

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
