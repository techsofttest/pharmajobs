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

class ProfileDemo extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string | UnitEnum | null $navigationGroup = 'User Management';

    protected static ?string $title = 'Profiles';

    protected static ?string $navigationLabel = 'Profiles';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected string $view = 'filament.pages.profile-demo';

    public function table(Table $table): Table
{
    return $table
        ->records(fn () => [
            [
        'name' => 'Rahul Kumar',
        'email' => 'rahul.kumar@example.com',
        'phone' => '9876543210',
        'designation' => 'Medical Representative',
        'location' => 'Kochi',
        'is_active' => true,
        'registered_on' => now()->subDays(12),
    ],
    [
        'name' => 'Anjali Nair',
        'email' => 'anjali.nair@example.com',
        'phone' => '9847012345',
        'designation' => 'Area Sales Manager',
        'location' => 'Kozhikode',
        'is_active' => true,
        'registered_on' => now()->subDays(25),
    ],
    [
        'name' => 'Vikram Singh',
        'email' => 'vikram.singh@example.com',
        'phone' => '9811122233',
        'designation' => 'Pharmacist',
        'location' => 'Bengaluru',
        'is_active' => false,
        'registered_on' => now()->subDays(40),
    ],
    [
        'name' => 'Sneha Reddy',
        'email' => 'sneha.reddy@example.com',
        'phone' => '9900123456',
        'designation' => 'Regulatory Affairs Executive',
        'location' => 'Hyderabad',
        'is_active' => true,
        'registered_on' => now()->subDays(5),
    ],
    [
        'name' => 'Arjun Patel',
        'email' => 'arjun.patel@example.com',
        'phone' => '9898989898',
        'designation' => 'Production Executive',
        'location' => 'Ahmedabad',
        'is_active' => true,
        'registered_on' => now()->subDays(18),
    ],
    [
        'name' => 'Meera Iyer',
        'email' => 'meera.iyer@example.com',
        'phone' => '9887766554',
        'designation' => 'Clinical Research Coordinator',
        'location' => 'Chennai',
        'is_active' => false,
        'registered_on' => now()->subDays(60),
    ],
    [
        'name' => 'Rohit Sharma',
        'email' => 'rohit.sharma@example.com',
        'phone' => '9823456789',
        'designation' => 'Territory Sales Officer',
        'location' => 'Mumbai',
        'is_active' => true,
        'registered_on' => now()->subDays(3),
    ]
           
        ])
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->weight('medium'),

            Tables\Columns\TextColumn::make('email')
                ->label('Email'),

            Tables\Columns\TextColumn::make('phone')
                ->label('Phone'),

            Tables\Columns\TextColumn::make('designation')
                ->label('Designation'),

            Tables\Columns\TextColumn::make('location')
                ->label('Location'),

            Tables\Columns\TextColumn::make('location')
                ->label('Location'),

            Tables\Columns\ToggleColumn::make('is_active')
                ->label('Active')
                ->sortable(),

            Tables\Columns\TextColumn::make('registered_on')
                ->label('Expiry')
                ->date('d M Y'),
        ])
        ->paginated(false);
        }

}