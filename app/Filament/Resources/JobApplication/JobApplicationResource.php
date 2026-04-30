<?php

namespace App\Filament\Resources\JobApplication;

use App\Filament\Resources\JobApplication\Pages;
use App\Filament\Resources\JobApplication\Tables\JobApplicationsTable;
use App\Models\JobApplication;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Job Management';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';
    
    protected static ?string $navigationLabel = 'Resumes';
    
    protected static ?string $modelLabel = 'Resume';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function table(Table $table): Table
    {
        return JobApplicationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobApplications::route('/'),
        ];
    }
}
