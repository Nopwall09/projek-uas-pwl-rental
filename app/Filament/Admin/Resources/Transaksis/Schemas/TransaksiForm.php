<?php

namespace App\Filament\Admin\Resources\Transaksis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('method_id')
    
                ->relationship('methodPembayaran', 'method') 
                ->label('Metode Pembayaran')
                        
                ->preload()
                ->required(),


                Select::make('rental_id')
                   ->relationship('rentalItem', 'rental_id')
                   ->label('ID Rental')
               
                   ->preload()
                   ->required(),
                DatePicker::make('tanggal_transaksi')
                    ->required(),
                Select::make('status')
                    ->options(['berhasi' => 'Berhasi', 'pending' => 'Pending', 'gagal' => 'Gagal'])
                    ->required(),
                TextInput::make('total_bayar')
                    ->required()
                    ->numeric(),
            ]);
    }
}
