<?php

namespace App\Filament\Resources\OuvrageResource\Pages;

use App\Filament\Resources\OuvrageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOuvrage extends CreateRecord
{
    protected static string $resource = OuvrageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
