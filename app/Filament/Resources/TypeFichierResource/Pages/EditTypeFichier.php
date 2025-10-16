<?php

namespace App\Filament\Resources\TypeFichierResource\Pages;

use App\Filament\Resources\TypeFichierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeFichier extends EditRecord
{
    protected static string $resource = TypeFichierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
