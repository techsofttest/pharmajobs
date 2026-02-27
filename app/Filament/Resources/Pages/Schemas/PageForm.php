<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;

use Filament\Forms\Components\RichEditor;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                    ->disabled(),
                RichEditor::make('content')
                    ->required(),
            ]);
    }
}
