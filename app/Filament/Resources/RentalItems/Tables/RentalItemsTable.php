<?php

namespace App\Filament\Resources\RentalItems\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;


class RentalItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ID Sewa
                TextColumn::make('rental_id')
                    ->label('ID')
                    ->sortable(),

                // Nama Penyewa 
                TextColumn::make('user.name')
                    ->label('Penyewa')
                    ->icon('heroicon-m-user')
                    ->searchable(),

                // Plat Mobil 
                TextColumn::make('mobil.mobil_plat')
                    ->label('Plat Mobil')
                    ->weight('bold')
                    ->searchable(),

                // Nama Driver 
                TextColumn::make('driver.driver_nama')
                    ->label('Driver')
                    ->placeholder('- Lepas Kunci -'),

                // Tanggal
                TextColumn::make('tgl')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // Lama Sewa
                TextColumn::make('lama_rental')
                    ->label('lama booking'),

                // Total Biaya 
                TextColumn::make('total_sewa')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                // Sumber Booking 
                TextColumn::make('booking_source')
                    ->label('Jenis booking')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'online' => 'info',
                        'offline' => 'gray',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}