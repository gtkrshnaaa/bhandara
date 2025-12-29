<?php

namespace App\Filament\App\Clusters\Catalog\Resources\ProductResource\Pages;

use App\Filament\App\Clusters\Catalog\Resources\ProductResource;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
