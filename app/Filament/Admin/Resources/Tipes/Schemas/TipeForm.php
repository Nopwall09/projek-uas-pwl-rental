<?php

namespace App\Filament\Admin\Resources\Tipes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TipeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tipe_nama')
                    ->required(),
            ]);
    }
}
