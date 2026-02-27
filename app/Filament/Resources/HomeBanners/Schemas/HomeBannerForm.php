<?php

namespace App\Filament\Resources\HomeBanners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class HomeBannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->required(),
            ]);
    }
}
