<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

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
                Tables\Columns\TextColumn::make('typeRapport.nom')
                    ->label('Type de rapport')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Formation' => 'success',
                        'Stage' => 'primary',
                        default => 'info',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('intitule'),
                Tables\Columns\TextColumn::make('debut_periode')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fin_periode')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
