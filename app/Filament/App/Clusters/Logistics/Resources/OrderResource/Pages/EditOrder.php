<?php

namespace App\Filament\App\Clusters\Logistics\Resources\OrderResource\Pages;

use App\Filament\App\Clusters\Logistics\Resources\OrderResource;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
