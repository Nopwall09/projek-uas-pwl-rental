<?php

namespace App\Filament\Admin\Resources\Transaksis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaksisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. ID Transaksi
                TextColumn::make('transaksi_id')
                    ->label('ID')
                    ->sortable(),

                // 2. Info Rental & Penyewa (Nested Relation)
                // Menampilkan ID Rental, dan kita bisa cari tahu siapa penyewanya lewat relasi rentalItem.user.name
                TextColumn::make('rentalItem.user.name') 
                    ->label('Penyewa')
                    ->description(fn ($record) => 'Rental ID: ' . $record->rental_id) // Info tambahan kecil di bawah nama
                    ->searchable()
                    ->sortable(),

                // 3. Metode Pembayaran (Teks)
                TextColumn::make('methodPembayaran.method') 
                    ->label('Metode')
                    ->badge() // Biar terlihat seperti label kecil
                    ->color('info'),

                // 4. Tanggal
                TextColumn::make('tanggal_transaksi')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // 5. Status Warna-Warni
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'berhasil' => 'success', // Hijau
                        'pending' => 'warning',  // Kuning
                        'gagal' => 'danger',     // Merah
                        default => 'gray',
                    }),

                // 6. Total Bayar (Rupiah)
                TextColumn::make('total_bayar')
                    ->label('Total')
                    ->money('IDR')
                    ->weight('bold')
                    ->sortable(),
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