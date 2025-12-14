<?php

namespace App\Filament\Admin\Resources\Tipes;

use App\Filament\Admin\Resources\Tipes\Pages\CreateTipe;
use App\Filament\Admin\Resources\Tipes\Pages\EditTipe;
use App\Filament\Admin\Resources\Tipes\Pages\ListTipes;
use App\Filament\Admin\Resources\Tipes\Schemas\TipeForm;
use App\Filament\Admin\Resources\Tipes\Tables\TipesTable;
use App\Models\Tipe;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TipeResource extends Resource
{
    protected static ?string $model = Tipe::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TipeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TipesTable::configure($table);
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
            'index' => ListTipes::route('/'),
            'create' => CreateTipe::route('/create'),
            'edit' => EditTipe::route('/{record}/edit'),
        ];
    }
}
