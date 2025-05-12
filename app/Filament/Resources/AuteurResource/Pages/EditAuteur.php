<?php

namespace App\Filament\Resources\AuteurResource\Pages;

use App\Filament\Resources\AuteurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAuteur extends EditRecord
{
    protected static string $resource = AuteurResource::class;

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
