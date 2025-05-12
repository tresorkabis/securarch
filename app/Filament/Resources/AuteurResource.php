<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuteurResource\Pages;
use App\Filament\Resources\AuteurResource\RelationManagers;
use App\Filament\Resources\AuteurResource\RelationManagers\OuvragesRelationManager;
use App\Models\Auteur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuteurResource extends Resource
{
    protected static ?string $model = Auteur::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gestion des ouvrages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('noms')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('biographie')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('noms')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ouvrages_count')
                    ->label('Nombre d\'ouvrages')
                    ->counts('ouvrages')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OuvragesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuteurs::route('/'),
            'create' => Pages\CreateAuteur::route('/create'),
            'edit' => Pages\EditAuteur::route('/{record}/edit'),
        ];
    }
}
