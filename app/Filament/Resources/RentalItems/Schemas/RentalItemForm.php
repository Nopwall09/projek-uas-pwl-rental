<?php

namespace App\Filament\Resources\RentalItems\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;

class RentalItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Penyewaan')
                    ->schema([
                        // Relasi ke penyewa atau user
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Penyewa')
                            // ->searchable()
                            ->preload()
                            ->required(),

                        // Relasi ke Mobil
                        Select::make('mobil_id')
                            ->relationship('mobil', 'mobil_plat') 
                            ->label('Mobil')
                            // ->searchable()
                            ->preload()
                            ->required(),

                        // Relasi ke Driver 
                        Select::make('driver_id')
                            ->relationship('driver', 'driver_nama')
                            ->label('Driver (Opsional)')
                            // ->searchable()
                            ->placeholder('Pilih jika menggunakan supir'),

                        // Tanggal Sewa
                        DatePicker::make('tgl')
                            ->label('Tanggal Mulai')
                            ->default(now())
                            ->required(),

                        // Lama Rental
                        TextInput::make('lama_rental')
                            ->label('Lama Sewa')
                            ->placeholder('Contoh: 2 Hari')
                            ->required(),

                        // Pilihan Paket
                        TextInput::make('pilihan')
                            ->label('Pilihan Paket')
                            ->placeholder('Contoh: Lepas Kunci / Dengan Supir'),

                        // Booking Source 
                        Select::make('booking_source')
                            ->options([
                                'online' => 'Online',
                                'offline' => 'Offline',
                            ])
                            ->label('Sumber Booking')
                            ->required(),

                        // Jaminan
                        TextInput::make('jaminan')
                            ->label('Jaminan')
                            ->placeholder('Contoh: KTP / Motor'),

                        // Total Harga
                        TextInput::make('total_sewa')
                            ->label('Total Biaya')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),
                    ])->columns(2)
            ]);
    }
}