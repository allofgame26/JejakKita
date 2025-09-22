<?php

namespace App\Filament\Resources\BarangResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\BarangResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = BarangResource::class;


    public function handler($id)
    {
        $model = static::getModel()::query();

        $query = QueryBuilder::for(
            $model->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        $transformer = static::getApiTransformer();
        
        return new $transformer($query);
    }
}
