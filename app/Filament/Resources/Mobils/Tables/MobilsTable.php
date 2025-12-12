<?php

namespace App\Filament\Resources\Mobils\Tables;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class MobilsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom-kolom tabel kamu
                TextColumn::make('merk.merk_nama')
                    ->label('Merk')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('mobil_plat')
                    ->label('Plat Nomor')
                    ->weight('bold')
                    ->searchable(),

                TextColumn::make('tipe.tipe_nama')
                    ->label('Tipe'),

                TextColumn::make('mobil_warna')
                    ->label('Warna'),

                TextColumn::make('status.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Tersedia' => 'success',
                        'Disewa' => 'danger',
                        'Perawatan' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('harga_rental')
                    ->label('Harga')
                    ->money('IDR')
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