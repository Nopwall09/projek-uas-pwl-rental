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

                ImageColumn::make('mobil_image')
                    ->label('Foto')
                    ->disk('public')
                    ->getStateUsing(fn($record) => $record->mobil_image),

                TextColumn::make('nama_mobil')
                    ->label('Nama'),

                TextColumn::make('merk.merk_nama')
                    ->label('Merk'),

                TextColumn::make('carclass.class_nama')
                    ->label('Kelas'),

                TextColumn::make('harga_rental')
                    ->label('Harga')
                    ->money('IDR'),


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
