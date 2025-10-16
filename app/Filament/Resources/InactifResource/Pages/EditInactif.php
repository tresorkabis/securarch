<?php

namespace App\Filament\Resources\InactifResource\Pages;

use App\Filament\Resources\InactifResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInactif extends EditRecord
{
    protected static string $resource = InactifResource::class;

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
