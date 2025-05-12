<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OuvrageResource\Pages;
use App\Filament\Resources\OuvrageResource\RelationManagers;
use App\Models\Ouvrage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OuvrageResource extends Resource
{
    protected static ?string $model = Ouvrage::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Gestion des ouvrages';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Select::make('auteur_id')
                    ->relationship('auteur', 'noms')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('domaine_id')
                    ->relationship('domaine', 'nom')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('isbn')
                    ->maxLength(255),
                Forms\Components\TextInput::make('editeur')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_publication'),
                Forms\Components\TextInput::make('nombre_pages')
                    ->numeric(),
                Forms\Components\TextInput::make('langue')
                    ->maxLength(255),
                Forms\Components\TextInput::make('format_fichier')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('taille_fichier')
                    ->maxLength(255),
                Forms\Components\TextInput::make('chemin_fichier')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('auteur.noms')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('domaine.nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('isbn')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('editeur')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_publication')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nombre_pages')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('langue')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('format_fichier')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('taille_fichier')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('chemin_fichier')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOuvrages::route('/'),
            'create' => Pages\CreateOuvrage::route('/create'),
            'edit' => Pages\EditOuvrage::route('/{record}/edit'),
        ];
    }
}
