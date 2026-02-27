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
                /*TextInput::make('description')
                    ->default(null),*/
            ]);
    }
}
