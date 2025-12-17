<?php

namespace App\Filament\Admin\Resources\CarClasses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CarClassForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('class_nama')->required()
                    ->unique(table: 'class', column: 'class_nama', ignoreRecord: true),
                    
            ]);
    }
}
