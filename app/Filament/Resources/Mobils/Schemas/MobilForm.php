<?php

namespace App\Filament\Resources\Mobils\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class MobilForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Klasifikasi Mobil')
                    ->description('Pilih data dari master data (Merk, Tipe, Kelas).')
                    ->schema([

                        FileUpload::make('mobil_image')
                            ->label('Foto Mobil')
                            ->image() 
                            ->directory('uploads/mobil') 
                            ->columnSpanFull(), 

                        // 1. Merk (Dropdown)
                        Select::make('merk_id')
                            ->relationship('merk', 'merk_nama')
                            ->label('Merk')
                            ->required(),

                        // 2. Tipe (Dropdown)
                        Select::make('tipe_id')
                            ->relationship('tipe', 'tipe_nama')
                            ->label('Tipe Bodi')
                            ->required(),

                        Select::make('class_id')
                            ->relationship('carclass', 'class_nama') 
                            ->label('Kelas')
                            ->required(),

                        // 4. Status (Dropdown)
                        Select::make('status_id')
                            ->relationship('status', 'status')
                            ->label('Status Ketersediaan')
                            ->default(1)
                            ->required(),
                    ])->columns(2), 

                Section::make('Detail Kendaraan')
                    ->schema([
                        TextInput::make('mobil_plat')
                            ->label('Plat Nomor')
                            ->placeholder('Contoh: AG 1234 XY')
                            ->required(),

                        TextInput::make('mobil_tahun')
                            ->label('Tahun')
                            ->numeric()
                            ->required(),

                        TextInput::make('mobil_warna')
                            ->label('Warna')
                            ->required(),

                        Select::make('Transmisi')
                            ->options([
                                'Manual' => 'Manual',
                                'Matic' => 'Matic',
                            ])
                            ->required(),

                        TextInput::make('harga_rental')
                            ->label('Harga Sewa per Hari')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),
                    ])->columns(2),
            ]);
    }
}