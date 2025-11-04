<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificationsRelationManager extends RelationManager
{
    protected static string $relationship = 'notifications';

    public function form(Form $form): Form
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
                Forms\Components\TextInput::make('grade')
                    ->maxLength(50),
                Forms\Components\Textarea::make('observations')
                    ->columnSpanFull(),
                Forms\Components\Select::make('decision_id')
                    ->relationship('decision', 'numero')
                    ->native(false)
                    ->required(),
                Forms\Components\FileUpload::make('fichier')
                    ->directory('notifications')
                    ->preserveFilenames()
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('objet')
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
