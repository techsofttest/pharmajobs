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
                TextColumn::make('employee.first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('employee.last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('employee.email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('employee.phone')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('job.designation.name')
                    ->label('Designation')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('job.title')
                    ->label('Job Post')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('job.company.company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('job.locations.name')
                    ->label('Location')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Applied On')
                    ->dateTime()
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
