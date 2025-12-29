<?php

namespace App\Filament\App\Clusters\Finance\Resources\TransactionResource\Pages;

use App\Filament\App\Clusters\Finance\Resources\TransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
}
