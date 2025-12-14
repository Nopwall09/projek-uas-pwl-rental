<?php

namespace App\Filament\Admin\Resources\Seats;

use App\Filament\Admin\Resources\Seats\Pages\CreateSeat;
use App\Filament\Admin\Resources\Seats\Pages\EditSeat;
use App\Filament\Admin\Resources\Seats\Pages\ListSeats;
use App\Filament\Admin\Resources\Seats\Schemas\SeatForm;
use App\Filament\Admin\Resources\Seats\Tables\SeatsTable;
use App\Models\Seat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SeatResource extends Resource
{
    protected static ?string $model = Seat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SeatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeatsTable::configure($table);
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
            'index' => ListSeats::route('/'),
            'create' => CreateSeat::route('/create'),
            'edit' => EditSeat::route('/{record}/edit'),
        ];
    }
}
