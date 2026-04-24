<?php

namespace App\Filament\Resources\Designations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use App\Models\Category;

class DesignationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('category_id')
                ->label('Category')
                ->options(Category::query()->pluck('name', 'id'))
                ->nullable()
                ->preload()
                ->searchable(),
                TextInput::make('name')
                    ->required(),
                
                Toggle::make('all_locations')
                    ->label('Apply to All Locations')
                    ->helperText('Enable this to make the designation available everywhere. Specific assignments will be cleared.')
                    ->live()
                    ->afterStateUpdated(function ($state, $record, $set) {
                        if ($state && $record) {
                            $record->locations()->detach();
                        }
                    }),

                \Filament\Forms\Components\Placeholder::make('all_locations_message')
                    ->label('')
                    ->content('This designation applies to all locations')
                    ->visible(fn ($get) => $get('all_locations')),

                Select::make('locations')
                    ->multiple()
                    ->relationship('locations', 'name')
                    ->label('Specific Locations')
                    ->helperText('Select the specific districts where this designation is available.')
                    ->placeholder('Search and select locations...')
                    ->searchable()
                    ->preload(false) // IMPORTANT: Performance for 1000+ locations
                    ->visible(fn ($get) => !$get('all_locations'))
                    ->required(fn ($get) => !$get('all_locations')),
            ]);
    }
}
