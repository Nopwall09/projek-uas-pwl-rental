<?php

namespace App\Filament\Resources\RentalItems;

use App\Filament\Resources\RentalItems\Pages\CreateRentalItem;
use App\Filament\Resources\RentalItems\Pages\EditRentalItem;
use App\Filament\Resources\RentalItems\Pages\ListRentalItems;
use App\Filament\Resources\RentalItems\Schemas\RentalItemForm;
use App\Filament\Resources\RentalItems\Tables\RentalItemsTable;
use App\Models\RentalItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RentalItemResource extends Resource
{
    protected static ?string $model = RentalItem::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';

    

    protected static ?string $navigationLabel = 'Kelola Data Rental';

    protected static ?string $pluralModelLabel = 'Data Rental Mobil';

    protected static ?string $modelLabel = 'Penyewaan';


    protected static ?string $recordTitleAttribute = 'history_id';

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
