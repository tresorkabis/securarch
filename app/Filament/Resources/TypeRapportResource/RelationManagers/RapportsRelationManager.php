<?php

namespace App\Filament\Resources\TypeRapportResource\RelationManagers;

use App\Filament\Resources\RapportResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RapportsRelationManager extends RelationManager
{
    protected static string $relationship = 'rapports';

    public function form(Form $form): Form
    {
        return RapportResource::form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('intitule')
            ->columns([
                Tables\Columns\TextColumn::make('intitule')
                    ->sortable()
                    ->searchable()
                    ->label('Intitulé'),
                Tables\Columns\TextColumn::make('agent.matricule')
                    ->sortable()
                    ->searchable()
                    ->label('Matricule'),
                Tables\Columns\TextColumn::make('agent.nom')
                    ->sortable()
                    ->searchable()
                    ->label('Nom'),
                Tables\Columns\TextColumn::make('agent.postnom')
                    ->sortable()
                    ->searchable()
                    ->label('Postnom'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
