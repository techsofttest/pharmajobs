<?php

namespace App\Filament\Resources\SeoMetas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SeoMetaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('page')
                    ->disabled(),
                TextInput::make('meta_title')
                    ->required(),
                TextInput::make('meta_description')
                    ->required(),
                Textarea::make('custom_head_scripts')
                    ->columnSpanFull(),
                Textarea::make('custom_body_scripts')
                    ->columnSpanFull(),
            ]);
    }
}
