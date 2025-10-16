<?php

namespace App\Filament\Resources\TypeFichierResource\Pages;

use App\Filament\Resources\TypeFichierResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeFichier extends CreateRecord
{
    protected static string $resource = TypeFichierResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
