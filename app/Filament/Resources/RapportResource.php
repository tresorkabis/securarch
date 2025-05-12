<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RapportResource\Pages;
use App\Filament\Resources\RapportResource\RelationManagers;
use App\Models\Rapport;
use App\Services\CountryService;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RapportResource extends Resource
{
    protected static ?string $model = Rapport::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Gestion des rapports';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        $countryService = app(CountryService::class);
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Select::make('type_rapport_id')
                            ->relationship('typeRapport', 'nom')
                            ->native(false)
                            ->required(),
                        Forms\Components\TextInput::make('intitule')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('debut_periode')
                            ->native(false)
                            ->required(),
                        Forms\Components\DatePicker::make('fin_periode')
                            ->native(false)
                            ->required(),
                        Forms\Components\Select::make('agent_id')
                            ->relationship('agent', 'nom')
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->required(),
                        Forms\Components\Select::make('pays')
                            ->options($countryService->getCountries())
                            ->searchable()
                            ->preload()
                            ->native(false),
                        Forms\Components\FileUpload::make('fichier')
                            ->directory('rapports')
                            ->preserveFilenames()
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                Tables\Columns\TextColumn::make('intitule')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('debut_periode')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fin_periode')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('agent.nom')
                    ->searchable()
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
                Tables\Filters\SelectFilter::make('type_rapport_id')
                    ->label('Type de rapport')
                    ->relationship('typeRapport', 'nom')
                    ->multiple()
                    ->preload()
                    ->placeholder('Tous les types de rapport'),
                Tables\Filters\SelectFilter::make('agent_id')
                    ->label('Agent')
                    ->relationship('agent', 'nom')
                    ->multiple()
                    ->preload()
                    ->placeholder('les agents'),
                Tables\Filters\Filter::make('periode')
                    ->form([
                        Forms\Components\DatePicker::make('debut_periode')
                            ->label('Date de début')
                            ->native(false),
                        Forms\Components\DatePicker::make('fin_periode')
                            ->label('Date de fin')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['debut_periode'],
                                fn(Builder $query, $date): Builder => $query->whereDate('debut_periode', '>=', $date),
                            )
                            ->when(
                                $data['fin_periode'],
                                fn(Builder $query, $date): Builder => $query->whereDate('fin_periode', '<=', $date),
                            );
                    }),
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
            'index' => Pages\ListRapports::route('/'),
            'create' => Pages\CreateRapport::route('/create'),
            'edit' => Pages\EditRapport::route('/{record}/edit'),
        ];
    }
}
