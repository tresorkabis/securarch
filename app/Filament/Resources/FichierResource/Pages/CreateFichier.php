<?php

namespace App\Filament\Resources\FichierResource\Pages;

use App\Filament\Resources\FichierResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFichier extends CreateRecord
{
    protected static string $resource = FichierResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
