<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Schemas\Schema;

class JobInfolist
{
    public static function configure($schema)
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Job Details')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('company.name')->label('Company'),
                        \Filament\Infolists\Components\TextEntry::make('title')->label('Job Title'),
                        \Filament\Infolists\Components\TextEntry::make('designation.name')->label('Designation'),
                        \Filament\Infolists\Components\TextEntry::make('qualification')->label('Qualification'),
                    ])->columns(2),
                \Filament\Schemas\Components\Section::make('Contact Info')
                    ->schema([
                        \Filament\Infolists\Components\TextEntry::make('contact_name')->label('Contact Person'),
                        \Filament\Infolists\Components\TextEntry::make('contact_email')->label('Email'),
                        \Filament\Infolists\Components\TextEntry::make('contact_phone')->label('Phone'),
                        \Filament\Infolists\Components\TextEntry::make('expires_at')->label('Expires At')->date(),
                    ])->columns(2),
            ]);
    }
}
