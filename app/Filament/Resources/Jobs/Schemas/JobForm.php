<?php

namespace App\Filament\Resources\Jobs\Schemas;

use Filament\Schemas\Schema;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class JobForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
            
            Section::make('Basic Information')
                    
                    ->schema([

                        Select::make('company_id')
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('designation_id')
                            ->relationship('designation', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('job_id')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),

                        TextInput::make('qualification')
                            ->required(),
                    ]),

                Section::make('Districts')
                    ->columns(1)
                    ->schema([
                        Select::make('districts')
                            ->relationship('districts', 'name')
                            ->helperText('Maximum 12 Locations')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->maxItems(12)
                            ->required(),
                    ]),

                Section::make('Contact Details')
                    ->columns(1)
                    ->schema([

                        TextInput::make('contact_name')
                            ->required(),

                        TextInput::make('contact_email')
                            ->email()
                            ->required(),

                        TextInput::make('contact_phone')
                            ->tel()
                            ->required(),
                    ]),

                Section::make('Job Criteria')
                    ->columns(1)
                    ->schema([

                        TextInput::make('min_experience')
                            ->numeric(),

                        TextInput::make('max_experience')
                            ->numeric(),

                        TextInput::make('max_age')
                            ->numeric(),

                        DatePicker::make('expires_at'),

                        //Toggle::make('is_active')
                            //->default(true),
                    ]),

            ]);
    }
}
