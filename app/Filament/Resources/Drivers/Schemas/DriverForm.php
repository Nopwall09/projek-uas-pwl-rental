<?php

namespace App\Filament\Resources\Drivers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class DriverForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Driver')
                    ->description('Masukkan data pribadi pengemudi sesuai dokumen asli.')
                    ->schema([
                        TextInput::make('driver_nama')
                            ->label('Nama Lengkap')
                            ->placeholder('Contoh: Budi Santoso')
                            ->required() // Wajib diisi
                            ->maxLength(100),

                        TextInput::make('driver_no_sim')
                            ->label('Nomor SIM')
                            ->placeholder('Masukkan 12-14 digit nomor SIM')
                            ->required()
                            ->numeric() // Hanya boleh angka
                            ->minLength(12),

                        TextInput::make('driver_no_telp')
                            ->label('Nomor Telepon/WhatsApp')
                            ->tel()
                            ->placeholder('Contoh: 08123456789')
                            ->required()
                            ->prefix('+62'), 
                    ])
                    ->columns(2), 
            ]);
    }
}