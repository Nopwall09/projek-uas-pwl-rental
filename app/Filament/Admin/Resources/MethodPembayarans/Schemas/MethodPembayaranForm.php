<?php

namespace App\Filament\Admin\Resources\MethodPembayarans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MethodPembayaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('method'),
            ]);
    }
}
