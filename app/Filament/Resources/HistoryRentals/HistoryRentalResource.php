<?php

namespace App\Filament\Resources\HistoryRentals;

use App\Filament\Resources\HistoryRentals\Pages\CreateHistoryRental;
use App\Filament\Resources\HistoryRentals\Pages\EditHistoryRental;
use App\Filament\Resources\HistoryRentals\Pages\ListHistoryRentals;
use App\Filament\Resources\HistoryRentals\Schemas\HistoryRentalForm;
use App\Filament\Resources\HistoryRentals\Tables\HistoryRentalsTable;
use App\Models\HistoryRental;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HistoryRentalResource extends Resource
{
    protected static ?string $model = HistoryRental::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'history_id';

    public static function form(Schema $schema): Schema
    {
        return HistoryRentalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HistoryRentalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHistoryRentals::route('/'),
            // 'create' => CreateHistoryRental::route('/create'),
            'edit' => EditHistoryRental::route('/{record}/edit'),
        ];
    }
}
