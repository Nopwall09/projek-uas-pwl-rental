<?php

namespace App\Filament\Admin\Resources\Tipes\Pages;

use App\Filament\Admin\Resources\Tipes\TipeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTipe extends EditRecord
{
    protected static string $resource = TipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
