<?php

namespace App\Filament\Widgets;

use App\Models\Domaine;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OuvragesChart extends ChartWidget
{
    protected static ?string $heading = 'Répartition Ouvrages par domaine';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Domaine::select('domaines.nom', DB::raw('COUNT(ouvrages.id) as count'))
            ->leftJoin('ouvrages', 'domaines.id', '=', 'ouvrages.domaine_id')
            ->groupBy('domaines.id', 'domaines.nom')
            ->get();

        return [
            'datasets' => [
                [
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                    ],
                ],
            ],
            'labels' => $data->pluck('nom')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],

            ],
        ];
    }
}
