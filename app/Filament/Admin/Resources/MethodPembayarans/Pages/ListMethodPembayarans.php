<?php

namespace App\Filament\Admin\Resources\MethodPembayarans\Pages;

use App\Filament\Admin\Resources\MethodPembayarans\MethodPembayaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMethodPembayarans extends ListRecords
{
    protected static string $resource = MethodPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
