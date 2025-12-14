<?php

namespace App\Filament\Admin\Resources\MethodPembayarans;

use App\Filament\Admin\Resources\MethodPembayarans\Pages\CreateMethodPembayaran;
use App\Filament\Admin\Resources\MethodPembayarans\Pages\EditMethodPembayaran;
use App\Filament\Admin\Resources\MethodPembayarans\Pages\ListMethodPembayarans;
use App\Filament\Admin\Resources\MethodPembayarans\Schemas\MethodPembayaranForm;
use App\Filament\Admin\Resources\MethodPembayarans\Tables\MethodPembayaransTable;
use App\Models\MethodPembayaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MethodPembayaranResource extends Resource
{
    protected static ?string $model = MethodPembayaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MethodPembayaranForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MethodPembayaransTable::configure($table);
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
            'index' => ListMethodPembayarans::route('/'),
            'create' => CreateMethodPembayaran::route('/create'),
            'edit' => EditMethodPembayaran::route('/{record}/edit'),
        ];
    }
}
