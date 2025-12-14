<?php

namespace App\Filament\Admin\Resources\Mobils\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class MobilsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Gambar Kecil Kotak
                ImageColumn::make('mobil_image')
                    ->label('Foto')
                    ->square(),
                    

                // Nama Merk (Tebal)
                TextColumn::make('merk.merk_nama')
                    ->label('Merk')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                // Plat Nomor
                TextColumn::make('mobil_plat')
                    ->label('Plat No')
                    ->searchable(),

                // // Status dengan Warna-Warni (Fitur Keren)
                // TextColumn::make('status.status_nama')
                //     ->label('Status'),

                // Tipe & Kelas
                TextColumn::make('tipe.tipe_nama')
                    ->label('Tipe'),

                TextColumn::make('carclass.class_nama')
                    ->label('Kelas'),

                // Harga Format Rupiah
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
