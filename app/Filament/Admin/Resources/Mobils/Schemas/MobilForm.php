<?php

namespace App\Filament\Admin\Resources\Mobils\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MobilForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('merk_id')
                    ->required()
                    ->numeric(),
                TextInput::make('status_id')
                    ->required()
                    ->numeric(),
                TextInput::make('class_id')
                    ->required()
                    ->numeric(),
                TextInput::make('tipe_id')
                    ->required()
                    ->numeric(),
                FileUpload::make('mobil_image')
                    ->image(),
                Select::make('Transmisi')
                    ->options(['Manual' => 'Manual', 'Matic' => 'Matic'])
                    ->required(),
                TextInput::make('mobil_warna')
                    ->required(),
                TextInput::make('mobil_plat')
                    ->required(),
                TextInput::make('mobil_tahun')
                    ->required(),
                TextInput::make('harga_rental')
                    ->required()
                    ->numeric(),
            ]);
    }
}
