<?php

namespace App\Filament\Admin\Resources\RentalItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RentalItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Nama Pelanggan (Relasi)
                TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->weight('bold'),

                // Mobil (Relasi)
                TextColumn::make('mobil.mobil_plat')
                    ->label('Mobil')
                    ->searchable(),

                // Tanggal
                TextColumn::make('tgl')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // Durasi
                TextColumn::make('lama_rental')
                    ->label('Durasi'),

                // Booking Source (Pakai Badge warna biar jelas dikit)
                TextColumn::make('booking_source')
                    ->label('Via')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'online' => 'success',
                        'offline' => 'info',
                        default => 'gray',
                    }),

                // Total Harga
                TextColumn::make('total_sewa')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('jaminan')
                    ->label('Jaminan')
                    ->toggleable(isToggledHiddenByDefault: true), // Sembunyi, bisa dimunculkan
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