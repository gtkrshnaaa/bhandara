<?php

namespace App\Filament\App\Clusters\Finance\Resources\TransactionResource\Pages;

use App\Filament\App\Clusters\Finance\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
