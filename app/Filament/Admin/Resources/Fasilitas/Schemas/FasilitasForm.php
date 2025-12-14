<?php

namespace App\Filament\Admin\Resources\Fasilitas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FasilitasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('fasilitas'),
            ]);
    }
}
