<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Designation;
use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SubAdminStats extends BaseWidget
{
    public static function canView(): bool
    {
        return auth()->user()?->isSubAdmin();
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Companies', Company::count())
                ->description('Total registered companies')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success'),
            Stat::make('Total Jobs', Job::count())
                ->description('Total active and inactive jobs')
                ->descriptionIcon('heroicon-m-identification')
                ->color('primary'),
            Stat::make('Total Designations', Designation::count())
                ->description('Total job designations')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning'),
        ];
    }
}
