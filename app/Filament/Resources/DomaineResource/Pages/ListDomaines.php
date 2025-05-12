<?php

namespace App\Filament\Resources\DomaineResource\Pages;

use App\Filament\Resources\DomaineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDomaines extends ListRecords
{
    protected static string $resource = DomaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
