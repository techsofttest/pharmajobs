<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),

                TextColumn::make('profile.first_name')
                    ->label('Employee')
                    ->formatStateUsing(fn ($record) => ($record->profile->first_name ?? '') . ' ' . ($record->profile->last_name ?? ''))
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                TextColumn::make('package.name')
                    ->label('Plan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->money('INR')
                    ->sortable(),

                TextColumn::make('order.status')
                    ->label('Payment')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'success' => 'success',
                        'pending' => 'warning',
                        'failed'  => 'danger',
                        default   => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state ?? 'N/A')),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active'    => 'success',
                        'expired'   => 'gray',
                        'cancelled' => 'danger',
                        default     => 'warning',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                TextColumn::make('starts_at')
                    ->label('Started')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('ends_at')
                    ->label('Expires')
                    ->date('d M Y')
                    ->sortable()
                    ->color(fn ($record) => $record->ends_at && now()->gt($record->ends_at) ? 'danger' : null),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active'    => 'Active',
                        'expired'   => 'Expired',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                //EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //DeleteBulkAction::make(),
                ]),
            ]);
    }
}
