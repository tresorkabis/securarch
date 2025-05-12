<?php

namespace App\Filament\Resources\OuvrageResource\Pages;

use App\Filament\Resources\OuvrageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOuvrage extends EditRecord
{
    protected static string $resource = OuvrageResource::class;

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
