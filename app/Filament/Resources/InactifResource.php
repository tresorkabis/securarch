<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InactifResource\Pages;
use App\Filament\Resources\InactifResource\RelationManagers;
use App\Models\Inactif;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InactifResource extends Resource
{
    protected static ?string $model = Inactif::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Gestion des agents';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('matricule')
                    ->maxLength(15),
                Forms\Components\TextInput::make('nom')
                    ->maxLength(50),
                Forms\Components\TextInput::make('postnom')
                    ->maxLength(50),
                Forms\Components\TextInput::make('prenom')
                    ->maxLength(50),
                Forms\Components\Select::make('sexe')
                    ->options(['F' => 'Féminin', 'M' => 'Masculin', 'ND' => 'Non défini']),
                Forms\Components\TextInput::make('anneedeces')
                    ->required()
                    ->numeric()
                    ->label('Année de décès')
                    ->default(0),
                Forms\Components\Textarea::make('observation')
                    ->columnSpanFull(),
                Forms\Components\Select::make('grade_id')
                    ->label("Grade")
                    ->relationship('grade', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('fonction_id')
                    ->label("Fonction")
                    ->relationship('fonction', 'name')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matricule')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postnom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sexe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('anneedeces')
                    ->numeric()
                    ->label('Année de décès')
                    ->sortable(),
                Tables\Columns\TextColumn::make('grade.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fonction.name')
                    ->numeric()
                    ->sortable(),
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
            ->actions([
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
            'index' => Pages\ListInactifs::route('/'),
            'create' => Pages\CreateInactif::route('/create'),
            'edit' => Pages\EditInactif::route('/{record}/edit'),
        ];
    }
}
