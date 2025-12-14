<?php

namespace App\Filament\Resources\Transaksis;

use App\Filament\Resources\Transaksis\Pages\CreateTransaksi;
use App\Filament\Resources\Transaksis\Pages\EditTransaksi;
use App\Filament\Resources\Transaksis\Pages\ListTransaksis;

use App\Filament\Resources\Transaksis\Schemas\TransaksiForm;
use App\Filament\Resources\Transaksis\Tables\TransaksisTable;

use App\Models\Transaksi;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    // Ganti icon string biasa agar aman
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-banknotes';
    
    protected static ?string $navigationLabel = 'Data Transaksi';

    protected static ?string $pluralModelLabel = 'Data Transaksi';
    protected static ?string $recordTitleAttribute = 'transaksi_id';

    public static function form(Schema $schema): Schema
    {
        return TransaksiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaksisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransaksis::route('/'),
            // 'create' => CreateTransaksi::route('/create'),
            'edit' => EditTransaksi::route('/{record}/edit'),
        ];
    }
}