<?php

namespace App\Filament\Resources\TypeRapportResource\Pages;

use App\Filament\Resources\TypeRapportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeRapport extends EditRecord
{
    protected static string $resource = TypeRapportResource::class;

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
