<?php

namespace App\Filament\Widgets;

use App\Models\Inactif;
use App\Models\Decision;
use App\Models\Agent;
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
            Stat::make('Agents', Agent::count())
                ->description('Nbre total des agents')
                ->descriptionIcon('heroicon-m-users')
                ->chart($this->getChartData(Agent::class))
                ->color('success')
                ->icon('heroicon-o-users'),

            Stat::make('Inactifs', Inactif::count())
                ->description('Les Inactifs')
                ->descriptionIcon('heroicon-m-user-circle')
                ->chart($this->getChartData(Inactif::class))
                ->color('primary')
                ->icon('heroicon-o-user-circle'),

            Stat::make('Décisions', Decision::count())
                ->description('Les Décisions')
                ->descriptionIcon('heroicon-m-folder')
                ->chart($this->getChartData(Decision::class))
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
