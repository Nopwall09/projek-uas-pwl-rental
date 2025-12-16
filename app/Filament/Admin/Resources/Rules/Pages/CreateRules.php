<?php

namespace App\Filament\Admin\Resources\Rules\Pages;

use App\Filament\Admin\Resources\Rules\RulesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRules extends CreateRecord
{
    protected static string $resource = RulesResource::class;

    protected function getRedirectUrl(): string
    {
        // Tetap di halaman tambah setelah simpan
        return $this->getUrl();
    }
}
