<?php

namespace App\Filament\Admin\Resources\RentalItems\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;

class RentalItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Input Transaksi Rental')
                    ->schema([
                        // --- DATA UTAMA (WAJIB PILIH DARI DATA YANG ADA) ---
                        // Note: Jika list kosong, berarti kamu harus input data User/Mobil dulu di menu masing-masing
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Nama Pelanggan')
                    
                            ->preload()
                            ->required(),

                        Select::make('mobil_id')
                            ->relationship('mobil', 'mobil_plat')
                            ->label('Pilih Mobil (Plat)')
                        
                            ->preload()
                            ->required(),

                        Select::make('driver_id')
                            ->relationship('driver', 'driver_nama')
                            ->label('Pilih Driver (Opsional)')
                            ->placeholder('Kosongkan jika lepas kunci')
                       
                            ->preload(),

                        // --- DATA INPUT MANUAL (SEKARANG LEBAR PENUH / FULL WIDTH) ---
                        
                        DatePicker::make('tgl')
                            ->label('Tanggal Sewa')
                            ->default(now())
                            ->required(),

                        TextInput::make('lama_rental')
                            ->label('Lama Sewa')
                            ->placeholder('Contoh: 2 Hari') // Petunjuk pengisian
                            ->required(),

                        TextInput::make('pilihan')
                            ->label('Opsi Tambahan')
                            ->placeholder('Contoh: Lepas Kunci / Dengan Supir')
                            ->required(),
                        
                        Select::make('booking_source')
                            ->label('Sumber Booking')
                            ->options([
                                'online' => 'Online', 
                                'offline' => 'Offline'
                            ])
                            ->default('offline')
                            ->required(),

                        TextInput::make('jaminan')
                            ->label('Jaminan')
                            ->placeholder('Contoh: KTP Asli / Motor')
                            ->required(),

                        TextInput::make('total_sewa')
                            ->label('Total Biaya')
                            ->prefix('Rp')
                            ->numeric()
                            ->required(),
                            
                    ])->columns(1) // 🔥 UBAH KE 1 AGAR SEMUA INPUTAN LEBAR (TIDAK KECIL)
            ]);
    }
}