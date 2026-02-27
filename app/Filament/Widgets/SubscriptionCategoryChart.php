<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SubscriptionCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Subscriptions By Category';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Pharmaceutical',
                    'data' => [20, 35, 40, 55, 60, 75],
                    'backgroundColor' => '#4ade80', // green
                ],
                [
                    'label' => 'Para Medical',
                    'data' => [10, 18, 25, 30, 42, 50],
                    'backgroundColor' => '#60a5fa', // blue
                ],
                [
                    'label' => 'Doctors',
                    'data' => [5, 12, 18, 22, 30, 38],
                    'backgroundColor' => '#facc15', // yellow
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
