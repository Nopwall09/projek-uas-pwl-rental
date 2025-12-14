<?php

namespace App\Filament\Admin\Resources\RentalItems;

use App\Filament\Admin\Resources\RentalItems\Pages\CreateRentalItem;
use App\Filament\Admin\Resources\RentalItems\Pages\EditRentalItem;
use App\Filament\Admin\Resources\RentalItems\Pages\ListRentalItems;
use App\Filament\Admin\Resources\RentalItems\Schemas\RentalItemForm;
use App\Filament\Admin\Resources\RentalItems\Tables\RentalItemsTable;
use App\Models\RentalItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RentalItemResource extends Resource
{
    protected static ?string $model = RentalItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RentalItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RentalItemsTable::configure($table);
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
            'index' => ListRentalItems::route('/'),
            'create' => CreateRentalItem::route('/create'),
            'edit' => EditRentalItem::route('/{record}/edit'),
        ];
    }
}
