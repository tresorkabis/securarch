<?php

namespace App\Filament\Resources\DomaineResource\RelationManagers;

use App\Filament\Resources\OuvrageResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OuvragesRelationManager extends RelationManager
{
    protected static string $relationship = 'ouvrages';

    public function form(Form $form): Form
    {
        return OuvrageResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                Tables\Columns\TextColumn::make('titre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('auteur.noms')
                    ->label('Auteur')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
