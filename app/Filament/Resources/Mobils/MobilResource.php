<?php

namespace App\Filament\Resources\Mobils;

use App\Filament\Resources\Mobils\Pages;
use App\Filament\Resources\Mobils\Schemas\MobilForm; // File Form terpisah
use App\Filament\Resources\Mobils\Tables\MobilsTable; // File Table terpisah
use App\Models\Mobil;
use Filament\Resources\Resource;

// --- PERBAIKAN 1: Import Schema (BUKAN Form) untuk v4 ---
use Filament\Schemas\Schema; 
// --------------------------------------------------------

use Filament\Tables\Table;

class MobilResource extends Resource
{
    protected static ?string $model = Mobil::class;


    
    protected static ?string $navigationLabel = 'Data Mobil';

    protected static ?string $recordTitleAttribute = 'mobil_plat';

    // --- PERBAIKAN 2: Ubah (Form $form) menjadi (Schema $schema) ---
    public static function form(Schema $schema): Schema
    {
        // Memanggil konfigurasi dari file MobilForm.php
        return MobilForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // Memanggil konfigurasi dari file MobilsTable.php
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