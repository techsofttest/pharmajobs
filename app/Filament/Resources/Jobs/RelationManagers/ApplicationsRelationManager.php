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
                //
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
                ]),
            ]);
    }
}
