<?php

namespace App\Filament\Resources\HistoryRentals\Pages;

use App\Filament\Resources\HistoryRentals\HistoryRentalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHistoryRentals extends ListRecords
{
    protected static string $resource = HistoryRentalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
