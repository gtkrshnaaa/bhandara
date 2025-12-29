<?php

namespace App\Filament\App\Clusters\Logistics\Resources\OrderResource\Pages;

use App\Filament\App\Clusters\Logistics\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
