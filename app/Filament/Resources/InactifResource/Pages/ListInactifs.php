<?php

namespace App\Filament\Resources\InactifResource\Pages;

use App\Filament\Resources\InactifResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInactifs extends ListRecords
{
    protected static string $resource = InactifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
