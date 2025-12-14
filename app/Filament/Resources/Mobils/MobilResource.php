<?php

namespace App\Filament\Resources\Mobils;

use App\Filament\Resources\Mobils\Pages;
use App\Filament\Resources\Mobils\Schemas\MobilForm; 
use App\Filament\Resources\Mobils\Tables\MobilsTable; 
use App\Models\Mobil;
use Filament\Resources\Resource;

use Filament\Schemas\Schema; 
// --------------------------------------------------------

use Filament\Tables\Table;

class MobilResource extends Resource
{
    protected static ?string $model = Mobil::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-truck';


    
    protected static ?string $navigationLabel = 'Data Mobil';

    protected static ?string $pluralModelLabel = 'Data mobil';

    protected static ?string $modelLabel = 'Data Mobil Baru';

    protected static ?string $recordTitleAttribute = 'mobil_plat';

    public static function form(Schema $schema): Schema
    {
        return MobilForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MobilsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMobils::route('/'),
            'create' => Pages\CreateMobil::route('/create'),
            'edit' => Pages\EditMobil::route('/{record}/edit'),
        ];
    }
}