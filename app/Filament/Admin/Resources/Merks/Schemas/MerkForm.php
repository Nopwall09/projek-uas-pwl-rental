<?php

namespace App\Filament\Admin\Resources\Merks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class MerkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('merk_nama')
                    ->label('Nama Merk')
                    ->required()
                    ->rules(function ($record) {
                        return [
                            Rule::unique('merk', 'merk_nama')->ignore($record?->merk_id),
                        ];
                    })
                    ->reactive(), // supaya bisa live validasi
            ]);
    }
}
