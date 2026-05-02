<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Schemas\Schema;

class ProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Profile Information')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('first_name'),
                        \Filament\Infolists\Components\TextEntry::make('last_name'),
                        \Filament\Infolists\Components\TextEntry::make('email'),
                        \Filament\Infolists\Components\TextEntry::make('phone'),
                        \Filament\Infolists\Components\TextEntry::make('role')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'employer' => 'success',
                                'employee' => 'primary',
                                default => 'gray',
                            }),
                        \Filament\Infolists\Components\IconEntry::make('is_active')
                            ->label('Active')
                            ->boolean(),
                    ])->columns(2),

                \Filament\Schemas\Components\Section::make('Company Information')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('employer.company.name')
                            ->label('Company Name'),
                        \Filament\Infolists\Components\TextEntry::make('employer.company.email')
                            ->label('Company Email'),
                        \Filament\Infolists\Components\TextEntry::make('employer.company.phone')
                            ->label('Company Phone'),
                    ])
                    ->columns(2)
                    ->visible(fn ($record) => $record->role === 'employer'),
            ]);
    }
}
