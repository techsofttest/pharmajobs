<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function canView(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}
