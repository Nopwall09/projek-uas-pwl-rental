<?php

namespace App\Filament\Admin\Resources\Transaksis\Pages;

use App\Filament\Admin\Resources\Transaksis\TransaksiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaksi extends EditRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
