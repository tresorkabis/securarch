<?php

namespace App\Filament\Resources\InactifResource\Pages;

use App\Filament\Resources\InactifResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInactif extends CreateRecord
{
    protected static string $resource = InactifResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
