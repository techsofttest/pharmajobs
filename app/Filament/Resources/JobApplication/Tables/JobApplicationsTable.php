<?php

namespace App\Filament\Resources\JobApplication\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Support\Collection;

class JobApplicationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job.designation.category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('employee_full_name')
                    ->label('Full Name')
                    ->state(function (\App\Models\JobApplication $record): string {
                        return trim(($record->employee?->first_name ?? '') . ' ' . ($record->employee?->last_name ?? ''));
                    })
                    ->searchable(query: function (\Illuminate\Database\Eloquent\Builder $query, string $search): \Illuminate\Database\Eloquent\Builder {
                        return $query->whereHas('employee', function ($q) use ($search) {
                            $q->where('first_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%");
                        });
                    }),

                TextColumn::make('job.designation.name')
                    ->label('Designation')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('job.locations.name')
                    ->label('Location')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('cv_download')
                    ->label('CV')
                    ->state(function (\App\Models\JobApplication $record) {
                        return ($record->resume ?? $record->employee?->employee?->cv) ? 'Download CV' : 'No CV';
                    })
                    ->color(function (string $state) {
                        return $state === 'Download CV' ? 'primary' : 'gray';
                    })
                    ->url(function (\App\Models\JobApplication $record) {
                        $cv = $record->resume ?? $record->employee?->employee?->cv;
                        return $cv ? \Illuminate\Support\Facades\Storage::url($cv) : null;
                    }, shouldOpenInNewTab: true)
                    ->icon(function (string $state) {
                        return $state === 'Download CV' ? 'heroicon-o-document-arrow-down' : 'heroicon-o-x-circle';
                    }),

                TextColumn::make('created_at')
                    ->label('Apply Date')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('designation')
                    ->relationship('job.designation', 'name')
                    ->searchable()
                    ->preload(),
                \Filament\Tables\Filters\SelectFilter::make('location')
                    ->relationship('job.locations', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->headerActions([
                Action::make('export_csv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($livewire) {
                        $query = $livewire->getFilteredTableQuery();
                        $records = $query->with(['employee', 'job', 'job.company', 'job.designation', 'job.locations'])->get();
                        
                        $filename = 'applications_export_' . now()->format('Y-m-d_His') . '.csv';
                        
                        return response()->streamDownload(function () use ($records) {
                            $handle = fopen('php://output', 'w');
                            fputcsv($handle, ['ID', 'Full Name', 'Email', 'Phone', 'Designation', 'Job Post', 'Company', 'Location', 'Applied On']);

                            foreach ($records as $record) {
                                fputcsv($handle, [
                                    $record->id,
                                    ($record->employee?->first_name ?? '') . ' ' . ($record->employee?->last_name ?? ''),
                                    $record->employee?->email ?? 'N/A',
                                    $record->employee?->phone ?? 'N/A',
                                    $record->job?->designation?->name ?? 'N/A',
                                    $record->job?->title ?? 'N/A',
                                    $record->job?->company?->company_name ?? 'N/A',
                                    $record->job?->locations->pluck('name')->implode(', '),
                                    $record->created_at?->format('Y-m-d H:i') ?? 'N/A',
                                ]);
                            }
                            fclose($handle);
                        }, $filename, ['Content-Type' => 'text/csv']);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('export_selected')
                        ->label('Export Selected')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (Collection $records) {
                            $filename = 'applications_selected_export_' . now()->format('Y-m-d_His') . '.csv';
                            return response()->streamDownload(function () use ($records) {
                                $handle = fopen('php://output', 'w');
                                fputcsv($handle, ['ID', 'Full Name', 'Email', 'Phone', 'Designation', 'Job Post', 'Company', 'Location', 'Applied On']);
                                foreach ($records as $record) {
                                    $record->load(['employee', 'job', 'job.company', 'job.designation', 'job.locations']);
                                    fputcsv($handle, [
                                        $record->id,
                                        ($record->employee?->first_name ?? '') . ' ' . ($record->employee?->last_name ?? ''),
                                        $record->employee?->email ?? 'N/A',
                                        $record->employee?->phone ?? 'N/A',
                                        $record->job?->designation?->name ?? 'N/A',
                                        $record->job?->title ?? 'N/A',
                                        $record->job?->company?->company_name ?? 'N/A',
                                        $record->job?->locations->pluck('name')->implode(', '),
                                        $record->created_at?->format('Y-m-d H:i') ?? 'N/A',
                                    ]);
                                }
                                fclose($handle);
                            }, $filename, ['Content-Type' => 'text/csv']);
                        }),
                ]),
            ]);
    }
}
