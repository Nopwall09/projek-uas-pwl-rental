<?php

namespace App\Filament\Admin\Resources\Tipes\Pages;

use App\Filament\Admin\Resources\Tipes\TipeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTipes extends ListRecords
{
    protected static string $resource = TipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
