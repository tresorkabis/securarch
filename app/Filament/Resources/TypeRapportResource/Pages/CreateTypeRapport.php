<?php

namespace App\Filament\Resources\TypeRapportResource\Pages;

use App\Filament\Resources\TypeRapportResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeRapport extends CreateRecord
{
    protected static string $resource = TypeRapportResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
