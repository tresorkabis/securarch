<?php

namespace App\Filament\Resources\TypeRapportResource\Pages;

use App\Filament\Resources\TypeRapportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeRapports extends ListRecords
{
    protected static string $resource = TypeRapportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
