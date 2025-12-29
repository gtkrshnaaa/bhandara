<?php

namespace App\Filament\App\Clusters\Logistics\Resources\OrderResource\Pages;

use App\Filament\App\Clusters\Logistics\Resources\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
