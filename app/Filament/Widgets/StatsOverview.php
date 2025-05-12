<?php

namespace App\Filament\Widgets;

use App\Models\Auteur;
use App\Models\Domaine;
use App\Models\Ouvrage;
use App\Models\Rapport;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Ouvrages', Ouvrage::count())
                ->description('Total des documents')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart($this->getChartData(Ouvrage::class))
                ->color('success')
                ->icon('heroicon-o-book-open'),

            Stat::make('Auteurs', Auteur::count())
                ->description('Contributeurs actifs')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart($this->getChartData(Auteur::class))
                ->color('primary')
                ->icon('heroicon-o-user-group'),

            Stat::make('Domaines', Domaine::count())
                ->description('Domaines des ouvrages')
                ->descriptionIcon('heroicon-m-folder')
                ->chart($this->getChartData(Domaine::class))
                ->color('warning')
                ->icon('heroicon-o-folder'),

            Stat::make('Rapports', Rapport::count())
                ->description('Rapports soumis')
                ->descriptionIcon('heroicon-m-document-text')
                ->chart($this->getChartData(Rapport::class))
                ->color('info')
                ->icon('heroicon-o-document-text'),
        ];
    }

    protected function getChartData(string $model): array
    {
        return collect(range(6, 0))
            ->map(fn(int $days) => Carbon::now()->subDays($days))
            ->map(fn(Carbon $date) => $model::whereDate('created_at', $date)->count())
            ->toArray();
    }
}
