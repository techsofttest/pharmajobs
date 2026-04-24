<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Subscription;
use Filament\Widgets\ChartWidget;

class SubscriptionCategoryChart extends ChartWidget
{
    protected ?string $heading = 'Active Subscriptions By Category';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $categories = Category::all();
        $counts = [];
        $labels = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;
            $counts[] = Subscription::whereHas('package', function ($q) use ($category) {
                $q->where('category_id', $category->id);
            })->where('status', 'active')
              ->where('ends_at', '>=', now())
              ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Subscriptions',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#4ade80', // green
                        '#60a5fa', // blue
                        '#facc15', // yellow
                        '#f87171', // red
                        '#a78bfa', // purple
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
