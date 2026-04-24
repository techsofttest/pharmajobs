<?php

namespace App\Filament\Resources\Jobs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class JobsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

            ToggleColumn::make('is_active')
                ->label('Active / Approval')
                ->sortable(),

            TextColumn::make('company.name')
                ->label('Company')
                ->searchable()
                ->sortable(),

            TextColumn::make('designation.name')
                ->label('Designation')
                ->searchable()
                ->sortable(),

            TextColumn::make('locations.name')
                ->label('Locations')
                ->badge()
                ->color('primary')
                ->searchable(),

            TextColumn::make('contact_name')
                ->label('Contact')
                ->searchable()
                ->toggleable(),

            TextColumn::make('contact_email')
                ->label('Email')
                ->searchable()
                ->toggleable(),

            TextColumn::make('contact_phone')
                ->label('Phone')
                ->searchable()
                ->toggleable()
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ]),
                \Filament\Tables\Filters\SelectFilter::make('designation_id')
                    ->label('Designation')
                    ->relationship('designation', 'name')
                    ->searchable()
                    ->preload(),
                \Filament\Tables\Filters\SelectFilter::make('locations')
                    ->label('Location')
                    ->relationship('locations', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                \Filament\Actions\Action::make('export')
                    ->label('Export CSV')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($livewire) {
                        $query = $livewire->getFilteredTableQuery();
                        $jobs = $query->with(['company', 'locations', 'designation'])->get();
                        
                        $filename = 'jobs_export_' . now()->format('Y-m-d_His') . '.csv';
                        
                        return response()->streamDownload(function () use ($jobs) {
                            $handle = fopen('php://output', 'w');
                            fputcsv($handle, ['ID', 'Company', 'Job Title', 'Designation', 'Locations', 'Contact Name', 'Contact Email', 'Contact Phone', 'Status']);

                            foreach ($jobs as $job) {
                                fputcsv($handle, [
                                    $job->id,
                                    $job->company?->company_name ?? 'N/A',
                                    $job->title,
                                    $job->designation?->name ?? 'N/A',
                                    $job->locations->pluck('name')->implode(', '),
                                    $job->contact_name,
                                    $job->contact_email,
                                    $job->contact_phone,
                                    $job->is_active ? 'Active' : 'Inactive',
                                ]);
                            }
                            fclose($handle);
                        }, $filename, ['Content-Type' => 'text/csv']);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    \Filament\Actions\BulkAction::make('export_selected')
                        ->label('Export Selected')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $filename = 'jobs_selected_export_' . now()->format('Y-m-d_His') . '.csv';
                            return response()->streamDownload(function () use ($records) {
                                $handle = fopen('php://output', 'w');
                                fputcsv($handle, ['ID', 'Company', 'Job Title', 'Designation', 'Locations', 'Contact Name', 'Contact Email', 'Contact Phone', 'Status']);
                                foreach ($records as $job) {
                                    $job->load(['company', 'locations', 'designation']);
                                    fputcsv($handle, [
                                        $job->id,
                                        $job->company?->company_name ?? 'N/A',
                                        $job->title,
                                        $job->designation?->name ?? 'N/A',
                                        $job->locations->pluck('name')->implode(', '),
                                        $job->contact_name,
                                        $job->contact_email,
                                        $job->contact_phone,
                                        $job->is_active ? 'Active' : 'Inactive',
                                    ]);
                                }
                                fclose($handle);
                            }, $filename, ['Content-Type' => 'text/csv']);
                        }),
                ]),
            ]);
    }
}
