<?php

namespace App\Filament\Admin\Resources\Rules;

use App\Filament\Admin\Resources\Rules\Pages\CreateRules;
use App\Filament\Admin\Resources\Rules\Pages\EditRules;
use App\Filament\Admin\Resources\Rules\Pages\ListRules;
use App\Filament\Admin\Resources\Rules\Schemas\RulesForm;
use App\Filament\Admin\Resources\Rules\Tables\RulesTable;
use App\Models\Rules;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RulesResource extends Resource
{
    protected static ?string $model = Rules::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RulesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RulesTable::configure($table);
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
            'index' => ListRules::route('/'),
            'create' => CreateRules::route('/create'),
            'edit' => EditRules::route('/{record}/edit'),
        ];
    }
}
