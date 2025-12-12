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
                // Mengelompokkan input ke dalam kotak (Section) agar lebih rapi
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
                            ->prefix('+62'), // Memberi awalan otomatis
                    ])
                    ->columns(2), // Membuat tampilan menjadi 2 kolom (Nama di kiri, SIM di kanan)
            ]);
    }
}