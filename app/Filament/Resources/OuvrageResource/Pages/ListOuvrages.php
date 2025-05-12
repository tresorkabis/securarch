<?php

namespace App\Filament\Resources\OuvrageResource\Pages;

use App\Filament\Resources\OuvrageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOuvrages extends ListRecords
{
    protected static string $resource = OuvrageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
