<?php

namespace App\Filament\Exports;

use App\Models\Profile;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Str;

class ProfileExporter extends Exporter
{
    protected static ?string $model = Profile::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('first_name'),
            ExportColumn::make('last_name'),
            ExportColumn::make('email'),
            ExportColumn::make('phone'),
            ExportColumn::make('role'),
            ExportColumn::make('employer.company.name')
                ->label('Company'),
            ExportColumn::make('is_active')
                ->label('Active'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your profile export has completed and ' . number_format($export->successful_rows) . ' ' . Str::plural('row', $export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . Str::plural('row', $failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
