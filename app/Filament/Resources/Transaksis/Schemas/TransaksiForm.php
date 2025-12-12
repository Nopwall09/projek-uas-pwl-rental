<?php

namespace App\Filament\Resources\Transaksis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Transaksi')
                    ->schema([
                        // Relasi ke Rental
                        Select::make('rental_id')
                            ->relationship('rentalItem', 'rental_id') 
                            ->label('ID Rental')
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Relasi ke Metode Pembayaran
                        Select::make('method_id')
                            ->relationship('methodPembayaran', 'pembayaran') 
                            ->label('Metode Pembayaran')
                            ->searchable()
                            ->preload()
                            ->required(),

                        // Tanggal
                        DatePicker::make('tanggal_transaksi')
                            ->label('Tanggal Transaksi')
                            ->default(now())
                            ->required(),

                        // Status (Dropdown)
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'berhasil' => 'Berhasil',
                                'gagal' => 'Gagal',
                            ])
                            ->default('pending')
                            ->required(),

                        // Total Bayar
                        TextInput::make('total_bayar')
                            ->label('Total Bayar')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),
                    ])->columns(2)
            ]);
    }
}