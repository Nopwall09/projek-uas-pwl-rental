<?php

namespace App\Filament\Admin\Resources\Drivers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DriverForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('driver_nama'),
                TextInput::make('driver_no_sim'),
                TextInput::make('driver_no_telp')
                    ->tel(),
            ]);
    }
}
