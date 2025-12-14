<?php

namespace App\Filament\Admin\Resources\Mobils\Schemas;

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
                Section::make('Input Data Mobil')
                    ->description('Silakan lengkapi data mobil dan upload fotonya.')
                    ->schema([
                        // 1. Foto (Paling Atas, Lebar Penuh)
                        FileUpload::make('mobil_image')
                            ->label('Foto Mobil')
                            ->image()
                            ->directory('uploads/mobil')
                            ->columnSpanFull() // Memanjang full
                            ->required(),

                        // 2. Data Klasifikasi (Dropdown Relasi)
                        Select::make('merk_id')
                            ->relationship('merk', 'merk_nama')
                            ->label('Merk')
                    
                            ->preload()
                            ->required(),

                        Select::make('tipe_id')
                            ->relationship('tipe', 'tipe_nama')
                            ->label('Tipe Bodi')
                
                            ->required(),

                        Select::make('class_id')
                            ->relationship('carclass', 'class_nama')
                            ->label('Kelas')
                            ->required(),

                        // Select::make('status_id')
                        //     ->relationship('status', 'status')
                        //     ->label('Status')
                        //     ->native(false)
                        //     ->required(),

                        // 3. Data Fisik Mobil
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
                            ->options(['Manual' => 'Manual', 'Matic' => 'Matic'])
                            ->required(),

                        // 4. Harga
                        TextInput::make('harga_rental')
                            ->label('Harga Sewa (Per Hari)')
                            ->prefix('Rp')
                            ->numeric()
                            ->columnSpanFull() // Harga dibuat panjang biar jelas
                            ->required(),

                    ])->columns(2) // 🔥 Ini kuncinya: Membagi layout jadi 2 kolom
            ]);
    }
}