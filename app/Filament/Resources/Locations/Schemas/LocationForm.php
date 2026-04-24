<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\State;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('state_id')
                    ->label('State')
                    ->options(State::query()->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->label('Location Name (District)')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
