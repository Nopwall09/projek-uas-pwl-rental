<?php

namespace App\Filament\Admin\Resources\Merks\Pages;

use App\Filament\Admin\Resources\Merks\MerkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMerks extends ListRecords
{
    protected static string $resource = MerkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
