<?php

namespace App\Filament\Resources\HistoryRentals\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;



class HistoryRentalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom ID 
                TextColumn::make('history_id')
                    ->label('ID Transaksi')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                // Kolom Nama Penyewa 
                TextColumn::make('user.name')
                    ->label('Penyewa')
                    ->icon('heroicon-m-user')
                    ->searchable(),

                // Kolom Aksi/Keterangan
                TextColumn::make('aksi')
                    ->label('Keterangan')
                    ->limit(30)
                    ->searchable(),

                // Kolom Status 
                TextColumn::make('status_book')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success', 
                        'confirmed' => 'info',    
                        'pending'   => 'warning', 
                        'canceled'  => 'danger',  
                        default     => 'gray',
                    }),

                // Kolom Waktu (Format Rapi)
                TextColumn::make('waktu')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i') 
                    ->sortable(),
            ])
            ->filters([
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