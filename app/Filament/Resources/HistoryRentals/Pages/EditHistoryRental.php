<?php

namespace App\Filament\Resources\HistoryRentals\Pages;

use App\Filament\Resources\HistoryRentals\HistoryRentalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHistoryRental extends EditRecord
{
    protected static string $resource = HistoryRentalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
