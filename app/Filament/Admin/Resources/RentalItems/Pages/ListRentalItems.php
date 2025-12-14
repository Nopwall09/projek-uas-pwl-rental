<?php

namespace App\Filament\Admin\Resources\RentalItems\Pages;

use App\Filament\Admin\Resources\RentalItems\RentalItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRentalItems extends ListRecords
{
    protected static string $resource = RentalItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
