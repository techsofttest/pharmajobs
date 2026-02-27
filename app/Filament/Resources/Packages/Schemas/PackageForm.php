<?php

namespace App\Filament\Resources\Packages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;

use Filament\Forms\Components\Select;
use App\Models\Category;

class PackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Select::make('category_id')
                ->label('Category')
                ->options(Category::query()->pluck('name', 'id'))
                ->preload()
                ->searchable(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('heading')
                    ->required(),

                Grid::make(2) // 2 columns in this row only
                ->schema([
                TextInput::make('duration_value')
                    ->required()
                    ->numeric(),
                Select::make('duration_unit')
                ->label('Duration Unit')
                ->options([
                    'month' => 'Month',
                    'year'  => 'Year',
                ])
                ->required()
                ]),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('₹')
            ]);
    }
}
