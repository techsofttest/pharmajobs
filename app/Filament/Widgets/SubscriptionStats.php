<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubscriptionStats extends BaseWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Active Subscriptions', 124)
                ->description('12% increase')
                ->color('success'),

            Stat::make('Expired Subscriptions', 18)
                ->description('3 expired today')
                ->color('danger'),

            Stat::make('Monthly Revenue', '₹1,24,500')
                ->description('From 87 payments')
                ->color('primary'),
        ];
    }
}