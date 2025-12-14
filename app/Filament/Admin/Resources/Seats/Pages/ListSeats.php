<?php

namespace App\Filament\Admin\Resources\Seats\Pages;

use App\Filament\Admin\Resources\Seats\SeatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSeats extends ListRecords
{
    protected static string $resource = SeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
