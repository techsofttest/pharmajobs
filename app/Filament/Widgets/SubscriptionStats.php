<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use App\Models\Order;
use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubscriptionStats extends BaseWidget
{

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $activeCount = Subscription::where('status', 'active')
            ->where('ends_at', '>=', now())
            ->count();
            
        $expiredCount = Subscription::where('ends_at', '<', now())->count();
        
        $monthlyRevenue = Order::where('status', 'success')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');
            
        $pendingJobs = Job::where('is_active', 0)->count();

        return [
            Stat::make('Active Subscriptions', $activeCount)
                ->color('success'),

            Stat::make('Monthly Revenue', '₹' . number_format($monthlyRevenue, 2))
                ->color('primary'),
                
            Stat::make('Pending Jobs', $pendingJobs)
                ->description('Awaiting approval')
                ->color('warning')
        ];
    }
}