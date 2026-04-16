<?php

namespace App\Filament\Resources\JobApplication\Pages;

use App\Filament\Resources\JobApplication\JobApplicationResource;
use Filament\Resources\Pages\ListRecords;

class ListJobApplications extends ListRecords
{
    protected static string $resource = JobApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
