<?php

namespace App\Filament\Resources\Jobs\Pages;

use App\Filament\Resources\Jobs\JobResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJob extends CreateRecord
{
    protected static string $resource = JobResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by_id'] = auth()->id();
        $data['created_by_type'] = auth()->user()::class;

        return $data;
    }

}
