<?php

namespace App\Filament\Resources\DomaineResource\Pages;

use App\Filament\Resources\DomaineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDomaine extends EditRecord
{
    protected static string $resource = DomaineResource::class;

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
