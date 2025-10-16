<?php

namespace App\Filament\Resources\TypeFichierResource\Pages;

use App\Filament\Resources\TypeFichierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeFichiers extends ListRecords
{
    protected static string $resource = TypeFichierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
