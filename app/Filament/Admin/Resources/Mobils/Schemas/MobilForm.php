<?php

namespace App\Filament\Admin\Resources\Mobils\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;

class MobilForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Input Data Mobil')
                ->columns(2)
                ->components([

                    FileUpload::make('mobil_image')
                        ->label('Foto Mobil')
                        ->image()
                        ->directory('mobil') // otomatis ke storage/app/public/mobil
                        ->disk('public'),  // pakai disk public agar bisa diakses via URL
                    Select::make('merk_id')
                        ->relationship('merk', 'merk_nama')
                        ->label('Merk')
                        ->required(),

                    TextInput::make('nama_mobil')
                        ->label('Nama Mobil')
                        ->required(),

                    Select::make('class_id')
                        ->relationship('carclass', 'class_nama')
                        ->label('Kelas')
                        ->required(),

                    Select::make('seat_id')
                        ->relationship('seat', 'seat_jumlah')
                        ->label('Jumlah Seat')
                        ->required(),

                    Repeater::make('fasilitas')
                        ->label('Fasilitas Mobil')
                        ->schema([
                            TextInput::make('nama')
                                ->label('Nama Fasilitas')
                                ->required(),
                        ])
                        ->addActionLabel('Tambah Fasilitas')
                        ->minItems(1)
                        ->columnSpanFull(),

                    Select::make('Transmisi')
                        ->options([
                            'Manual' => 'Manual',
                            'Matic'  => 'Matic',
                        ])
                        ->required(),

                    TextInput::make('mobil_warna')->required(),

                    TextInput::make('mobil_plat')->required(),

                    TextInput::make('mobil_tahun')
                        ->numeric()
                        ->minValue(1990)
                        ->maxValue(now()->year)
                        ->required(),
                    TextInput::make('harga_rental')
                        ->label('Biaya Driver / Hari')
                        ->numeric()
                        ->prefix('Rp')
                        ->default(0)
                        ->required(),
                ]),
        ]);
    }
}
