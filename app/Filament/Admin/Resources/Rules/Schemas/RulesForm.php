<?php

namespace App\Filament\Admin\Resources\Rules\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RulesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('rules')
                    ->label('Rules')
                    ->required()
                    ->rows(5)
                    ->maxLength(500),
            ]);
    }
}

