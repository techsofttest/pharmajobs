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
            ImageColumn::make('company.logo')
                ->label('Logo')
                ->circular()
                ->height(40),

            TextColumn::make('company.name')
                ->label('Company')
                ->searchable()
                ->sortable(),

            TextColumn::make('title')
                ->label('Job Title')
                ->searchable()
                ->sortable(),

            ToggleColumn::make('is_active')
                ->label('Active')
                ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
