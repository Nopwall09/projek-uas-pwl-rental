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
                // Kolom ID (Kode Unik)
                TextColumn::make('history_id')
                    ->label('ID Transaksi')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                // Kolom Nama Penyewa (Relasi User)
                TextColumn::make('user.name')
                    ->label('Penyewa')
                    ->icon('heroicon-m-user')
                    ->searchable(),

                // Kolom Aksi/Keterangan
                TextColumn::make('aksi')
                    ->label('Keterangan')
                    ->limit(30)
                    ->searchable(),

                // Kolom Status (Warna-warni)
                TextColumn::make('status_book')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success', // Hijau
                        'confirmed' => 'info',    // Biru
                        'pending'   => 'warning', // Kuning
                        'canceled'  => 'danger',  // Merah
                        default     => 'gray',
                    }),

                // Kolom Waktu (Format Rapi)
                TextColumn::make('waktu')
                    ->label('Waktu Kejadian')
                    ->dateTime('d M Y, H:i') 
                    ->sortable(),
            ])
            ->filters([
                // Filter bisa ditambahkan nanti
            ])
            // ✅ GUNAKAN 'actions' (Standar V4)
            ->recordActions([
                EditAction::make(),
            ])
            // GUNAKAN 'bulkActions' (JANGAN 'toolbarActions')
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}