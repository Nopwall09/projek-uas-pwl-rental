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
                TextInput::make('method_id')
                    ->required()
                    ->numeric(),
                TextInput::make('rental_id')
                    ->required()
                    ->numeric(),
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
