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
            ->schema(self::getFichierForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type_fichier.nom')
                    ->sortable(),
                Tables\Columns\TextColumn::make('inactif_full_name')
                    ->label('Agent')
                    ->getStateUsing(fn($record) => $record->inactif?->nom . ' ' . $record->inactif?->prenom . ' (' . $record->inactif?->matricule . ')')
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

    public static function getFichierForm(): array
    {
        return [
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
            Forms\Components\Select::make('inactif_id')
                ->label('Inactif')
                ->relationship('inactif', 'matricule', modifyQueryUsing: fn($query) => $query->whereNotNull('matricule'))
                ->getOptionLabelFromRecordUsing(fn($record) => "{$record->prenom} {$record->nom} ({$record->matricule})")
                ->searchable()
                ->preload()
                ->native(false),
        ];
    }
}
