<?php

namespace App\Filament\App\Clusters\Catalog\Resources\CategoryResource\Pages;

use App\Filament\App\Clusters\Catalog\Resources\CategoryResource;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
