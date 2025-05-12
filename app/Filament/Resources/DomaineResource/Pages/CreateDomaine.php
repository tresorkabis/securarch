<?php

namespace App\Filament\Resources\DomaineResource\Pages;

use App\Filament\Resources\DomaineResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDomaine extends CreateRecord
{
    protected static string $resource = DomaineResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
