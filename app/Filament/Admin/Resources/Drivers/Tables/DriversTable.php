<?php

namespace App\Filament\Admin\Resources\Drivers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DriversTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('driver_nama')
                    ->searchable(),
                TextColumn::make('status'),
                TextColumn::make('biaya_driver')
                    ->label('Biaya Driver')
                    ->formatStateUsing(function ($state) {
                        // Pastikan nilai null diubah menjadi 0
                        $state = $state ?? 0;
                        return 'Rp ' . number_format((float)$state, 0, ',', '.');
                    })
                    ->sortable(),

                TextColumn::make('driver_no_sim'),
                TextColumn::make('driver_no_telp'),
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
