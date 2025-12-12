<?php

namespace App\Filament\Resources\Transaksis\Tables;

use Filament\Tables\Table;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;


class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ID Transaksi
                TextColumn::make('transaksi_id')
                    ->label('ID Transaksi')
                    ->sortable()
                    ->searchable(),

                // Menampilkan Rental ID
                TextColumn::make('rentalItem.user.name') 
                    ->label('Penyewa')
                    ->icon('heroicon-m-user')
                    ->searchable()
                    ->sortable(),

                // menampilkan metode pembayaran
                TextColumn::make('methodPembayaran.method') 
                    ->label('Metode'),

                // menampilkan Tanggal 
                TextColumn::make('tanggal_transaksi')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // Status Warna-warni
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'berhasil' => 'success',
                        'pending' => 'warning',
                        'gagal' => 'danger',
                        default => 'gray',
                    }),

                // menampilkan total bayar
                TextColumn::make('total_bayar')
                    ->label('Total Bayar')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}