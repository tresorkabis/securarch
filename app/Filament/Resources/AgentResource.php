<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgentResource\Pages;
use App\Filament\Resources\AgentResource\RelationManagers;
use App\Filament\Resources\AgentResource\RelationManagers\RapportsRelationManager;
use App\Models\Agent;
use App\Services\AgentImportService;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

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
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('matricule')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postnom')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('prenom')
                            ->maxLength(255),
                        Forms\Components\Select::make('sexe')
                            ->options(['F' => 'Féminin', 'M' => 'Masculin', 'ND' => 'Non défini']),
                        Forms\Components\TextInput::make('fonction')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('telephone')
                            ->maxLength(255),
                    ])->columns(3),
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
                Tables\Columns\TextColumn::make('rapports_count')
                    ->label('Nombre de rapports')
                    ->counts('rapports')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexe')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('fonction')
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
            ->headerActions([
                Tables\Actions\Action::make('import')
                    ->label('Actualiser la liste des agents')
                    ->icon('heroicon-o-arrow-path')
                    ->color('info')
                    ->action(function (array $data): void {
                        $importSerice = app(AgentImportService::class);
                        $result = $importSerice->importAgents();

                        if ($result['success']) {
                            Notification::make()
                                ->title('Importation réussie')
                                ->body($result['message'] . ' (' . $result['count'] . ' agents importés)')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Erreur d\'importation')
                                ->body($result['message'])
                                ->danger()
                                ->send();
                        }
                    })
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
            RapportsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgents::route('/'),
            'view' => Pages\ViewAgent::route('/{record}/view'),
            'create' => Pages\CreateAgent::route('/create'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }
}
