<?php

namespace App\Filament\Resources\HistoryRentals\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HistoryRentalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('rental_id')
                    ->required()
                    ->numeric(),
                TextInput::make('aksi')
                    ->required(),
                Select::make('status_book')
                    ->options([
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'canceled' => 'Canceled',
            'completed' => 'Completed',
        ])
                    ->required(),
                DateTimePicker::make('waktu')
                    ->required(),
            ]);
    }
}
