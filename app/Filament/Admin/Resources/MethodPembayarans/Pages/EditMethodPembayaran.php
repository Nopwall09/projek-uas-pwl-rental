<?php

namespace App\Filament\Admin\Resources\MethodPembayarans\Pages;

use App\Filament\Admin\Resources\MethodPembayarans\MethodPembayaranResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMethodPembayaran extends EditRecord
{
    protected static string $resource = MethodPembayaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
