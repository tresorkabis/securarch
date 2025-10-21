<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Filament\Resources\NotificationResource\RelationManagers;
use App\Models\Notification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationGroup = 'Gestion des agents';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('numero')
                    ->maxLength(50),
                Forms\Components\TextInput::make('objet')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('matricule')
                    ->maxLength(20),
                Forms\Components\TextInput::make('grade')
                    ->maxLength(50),
                Forms\Components\Textarea::make('observations')
                    ->columnSpanFull(),
                Forms\Components\Select::make('decision_id')
                    ->relationship('decision', 'numero')
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('agent_id')
                    ->required()
                    ->relationship('agent', 'matricule', modifyQueryUsing: fn($query) => $query->whereNotNull('matricule'))->getOptionLabelFromRecordUsing(fn($record) => "{$record->prenom} {$record->nom} {$record->postnom} ({$record->matricule})")
                    ->searchable()
                    ->native(false)
                    ->preload(),
                Forms\Components\FileUpload::make('fichier')
                    ->directory('notifications')
                    ->preserveFilenames()
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('objet')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricule')
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('decision.numero')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agent.matricule')
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
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'edit' => Pages\EditNotification::route('/{record}/edit'),
        ];
    }
}
