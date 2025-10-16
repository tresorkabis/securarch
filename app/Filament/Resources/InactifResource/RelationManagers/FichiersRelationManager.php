<?php

namespace App\Filament\Resources\InactifResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FichiersRelationManager extends RelationManager
{
    protected static string $relationship = 'fichiers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('fichier')
                    ->label('Fichier')
                    ->directory('documents/')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->required()
                    ->maxSize(5120),
                Forms\Components\Select::make('type_fichier_id')
                    ->label('Type de fichier')
                    ->relationship('type_fichier', 'nom')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fichier')
            ->columns([
                Tables\Columns\TextColumn::make('fichier'),
                Tables\Columns\TextColumn::make('type_fichier.nom')
                    ->label('Type de fichier')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
