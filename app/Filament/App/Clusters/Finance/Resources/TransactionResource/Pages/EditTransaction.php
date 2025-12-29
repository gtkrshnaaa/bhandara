<?php

namespace App\Filament\App\Clusters\Finance\Resources\TransactionResource\Pages;

use App\Filament\App\Clusters\Finance\Resources\TransactionResource;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
