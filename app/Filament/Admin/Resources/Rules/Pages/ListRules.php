<?php

namespace App\Filament\Admin\Resources\Rules\Pages;

use App\Filament\Admin\Resources\Rules\RulesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRules extends ListRecords
{
    protected static string $resource = RulesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
