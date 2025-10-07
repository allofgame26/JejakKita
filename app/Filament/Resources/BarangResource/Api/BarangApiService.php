<?php
namespace App\Filament\Resources\BarangResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\BarangResource;
use Illuminate\Routing\Router;



class BarangApiService extends ApiService
{
    protected static string | null $resource = BarangResource::class;

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
