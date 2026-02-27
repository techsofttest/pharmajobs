<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use UnitEnum;

class SubscriptionDemo extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | UnitEnum | null $navigationGroup = 'User Management';

    protected static ?string $title = 'Employee Subscriptions';

    protected static ?string $navigationLabel = 'Subscriptions';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected string $view = 'filament.pages.subscription-demo';

    public function table(Table $table): Table
{
    return $table
        ->records(fn () => [
            [
                'employee' => 'Rahul Kumar',
                'plan' => 'Pharma Basic',
                'amount' => 999,
                'payment_status' => 'paid',
                'status' => 'active',
                'expires_at' => now()->addDays(25),
            ],
            [
                'employee' => 'Anjali Nair',
                'plan' => 'Premium Sales',
                'amount' => 1999,
                'payment_status' => 'pending',
                'status' => 'pending',
                'expires_at' => now()->addDays(30),
            ],
            [
                'employee' => 'Vikram Singh',
                'plan' => 'Medical Rep Plan',
                'amount' => 1499,
                'payment_status' => 'failed',
                'status' => 'cancelled',
                'expires_at' => now()->subDays(2),
            ],
        ])
        ->columns([
            Tables\Columns\TextColumn::make('employee')
                ->label('Employee')
                ->weight('medium'),

            Tables\Columns\TextColumn::make('plan')
                ->label('Plan'),

            Tables\Columns\TextColumn::make('amount')
                ->money('INR')
                ->sortable(),

            Tables\Columns\BadgeColumn::make('payment_status')
                ->colors([
                    'success' => 'paid',
                    'warning' => 'pending',
                    'danger' => 'failed',
                ])
                ->formatStateUsing(fn ($state) => ucfirst($state)),

            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'success' => 'active',
                    'warning' => 'pending',
                    'danger' => 'cancelled',
                ])
                ->formatStateUsing(fn ($state) => ucfirst($state)),

            Tables\Columns\TextColumn::make('expires_at')
                ->label('Expiry')
                ->date('d M Y'),
        ])
        ->paginated(false);
        }

}