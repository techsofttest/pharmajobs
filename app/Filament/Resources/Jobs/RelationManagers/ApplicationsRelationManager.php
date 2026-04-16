<?php

namespace App\Filament\Resources\Jobs\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
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
                    ->searchable()
                    ->sortable(),

                TextColumn::make('employee.phone')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Applied On')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Actions\Action::make('export')
                    ->label('Export Applicants')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($livewire) {
                        $query = $livewire->getFilteredTableQuery();
                        $records = $query->with(['employee'])->get();
                        
                        $filename = 'applicants_export_' . now()->format('Y-m-d_His') . '.csv';
                        
                        return response()->streamDownload(function () use ($records) {
                            $handle = fopen('php://output', 'w');
                            fputcsv($handle, ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Applied Date']);

                            foreach ($records as $record) {
                                fputcsv($handle, [
                                    $record->id,
                                    $record->employee?->first_name ?? 'N/A',
                                    $record->employee?->last_name ?? 'N/A',
                                    $record->employee?->email ?? 'N/A',
                                    $record->employee?->phone ?? 'N/A',
                                    $record->created_at?->format('Y-m-d H:i') ?? 'N/A',
                                ]);
                            }
                            fclose($handle);
                        }, $filename, ['Content-Type' => 'text/csv']);
                    }),
            ])
            ->actions([
                Action::make('download_cv')
                    ->label('Download CV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->url(fn ($record) => $record->employee?->employee?->cv ? asset('storage/' . $record->employee->employee->cv) : null)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => !empty($record->employee?->employee?->cv)),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                    \Filament\Actions\BulkAction::make('export_selected')
                        ->label('Export Selected')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $filename = 'applicants_selected_export_' . now()->format('Y-m-d_His') . '.csv';
                            return response()->streamDownload(function () use ($records) {
                                $handle = fopen('php://output', 'w');
                                fputcsv($handle, ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Applied Date']);
                                foreach ($records as $record) {
                                    fputcsv($handle, [
                                        $record->id,
                                        $record->employee?->first_name ?? 'N/A',
                                        $record->employee?->last_name ?? 'N/A',
                                        $record->employee?->email ?? 'N/A',
                                        $record->employee?->phone ?? 'N/A',
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
