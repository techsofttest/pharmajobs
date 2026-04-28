<?php

namespace App\Filament\Resources\Profiles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class ProfilesTable 
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(), 
                \Filament\Tables\Columns\TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'employer' => 'success',
                        'employee' => 'primary',
                        default => 'gray',
                    })
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('employer.company.name')
                    ->label('Company')
                    ->placeholder('N/A')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
                    ->sortable(),
            ])
            ->filters([
                
            ])
            ->headerActions([
                \Filament\Actions\Action::make('export')
                    ->label('Export CSV')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function ($livewire) {
                        $query = $livewire->getFilteredTableQuery();
                        $profiles = $query->with(['employer.company'])->get();
                        
                        $filename = 'profiles_export_' . now()->format('Y-m-d_His') . '.csv';
                        
                        return response()->streamDownload(function () use ($profiles) {
                            $handle = fopen('php://output', 'w');
                            fputcsv($handle, ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Role', 'Company', 'Status']);

                            foreach ($profiles as $profile) {
                                fputcsv($handle, [
                                    $profile->id,
                                    $profile->first_name,
                                    $profile->last_name,
                                    $profile->email,
                                    $profile->phone,
                                    $profile->role,
                                    ($profile->role === 'employer') ? ($profile->employer?->company?->name ?? 'N/A') : 'N/A',
                                    $profile->is_active ? 'Active' : 'Inactive',
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
                            $filename = 'profiles_selected_export_' . now()->format('Y-m-d_His') . '.csv';
                            return response()->streamDownload(function () use ($records) {
                                $handle = fopen('php://output', 'w');
                                fputcsv($handle, ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Role', 'Company', 'Status']);
                                foreach ($records as $profile) {
                                    $profile->load(['employer.company']);
                                    fputcsv($handle, [
                                        $profile->id,
                                        $profile->first_name,
                                        $profile->last_name,
                                        $profile->email,
                                        $profile->phone,
                                        $profile->role,
                                        ($profile->role === 'employer') ? ($profile->employer?->company?->name ?? 'N/A') : 'N/A',
                                        $profile->is_active ? 'Active' : 'Inactive',
                                    ]);
                                }
                                fclose($handle);
                            }, $filename, ['Content-Type' => 'text/csv']);
                        }),
                ]),
            ]);
    }
}
