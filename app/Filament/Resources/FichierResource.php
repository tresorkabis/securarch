<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FichierResource\Pages;
use App\Filament\Resources\FichierResource\RelationManagers;
use App\Models\Fichier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FichierResource extends Resource
{
    protected static ?string $model = Fichier::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Gestion des agents';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type_fichier_id')
                    ->numeric(),
                Forms\Components\Textarea::make('fichier')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('inactif_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type_fichier_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('inactif_id')
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
            'index' => Pages\ListFichiers::route('/'),
            'create' => Pages\CreateFichier::route('/create'),
            'edit' => Pages\EditFichier::route('/{record}/edit'),
        ];
    }
}
