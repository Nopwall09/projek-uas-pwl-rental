<?php

namespace App\Filament\Admin\Resources\CarClasses\Pages;

use App\Filament\Admin\Resources\CarClasses\CarClassResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCarClass extends CreateRecord
{
    protected static string $resource = CarClassResource::class;
}
