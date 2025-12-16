<?php

namespace App\Filament\Admin\Resources\Drivers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class DriverForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('driver_nama')
                ->label('Nama Driver')
                ->maxLength(50)
                ->required(),

            Select::make('status')
                ->label('Status')
                ->options([
                    'Tersedia' => 'Tersedia',
                    'Booked'   => 'Booked',
                ])
                ->default('Tersedia')
                ->required(),

            TextInput::make('biaya_driver')
                ->label('Biaya Driver / Hari')
                ->numeric()
                ->prefix('Rp')
                ->default(0)
                ->required(),

            TextInput::make('driver_no_sim')
                ->label('Nomor SIM')
                ->maxLength(20)
                ->required(),

            TextInput::make('driver_no_telp')
                ->label('No. Telepon')
                ->tel()
                ->maxLength(15)
                ->required(),
        ]);
    }
}
