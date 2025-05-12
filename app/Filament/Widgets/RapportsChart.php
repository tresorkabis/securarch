<?php

namespace App\Filament\Widgets;

use App\Models\TypeRapport;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RapportsChart extends ChartWidget
{
    protected static ?string $heading = 'Répartition Rapports par type';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = TypeRapport::select('type_rapports.nom', DB::raw('COUNT(rapports.id) as count'))
            ->leftJoin('rapports', 'type_rapports.id', '=', 'rapports.type_rapport_id')
            ->groupBy('type_rapports.id', 'type_rapports.nom')
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
