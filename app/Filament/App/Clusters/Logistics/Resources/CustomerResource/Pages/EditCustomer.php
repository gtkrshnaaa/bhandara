<?php

namespace App\Filament\App\Clusters\Logistics\Resources\CustomerResource\Pages;

use App\Filament\App\Clusters\Logistics\Resources\CustomerResource;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
