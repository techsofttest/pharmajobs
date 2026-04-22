<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use App\Models\Package;
use App\Models\Profile;
use App\Models\Order;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Subscription Details')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('profile_id')
                                ->label('Employee')
                                ->options(
                                    Profile::where('role', 'employee')
                                        ->get()
                                        ->mapWithKeys(fn ($p) => [
                                            $p->id => ($p->first_name ?? '') . ' ' . ($p->last_name ?? '') . ' (' . $p->email . ')',
                                        ])
                                )
                                ->searchable()
                                ->required(),

                            Select::make('package_id')
                                ->label('Package')
                                ->options(Package::pluck('name', 'id'))
                                ->searchable()
                                ->required(),
                        ]),

                        Grid::make(2)->schema([
                            Select::make('order_id')
                                ->label('Linked Order')
                                ->options(
                                    Order::where('status', 'success')
                                        ->get()
                                        ->mapWithKeys(fn ($o) => [
                                            $o->id => '#' . $o->id . ' — ₹' . number_format($o->amount, 2) . ' (' . $o->razorpay_order_id . ')',
                                        ])
                                )
                                ->searchable()
                                ->nullable(),

                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('₹'),
                        ]),
                    ]),

                Section::make('Duration & Status')
                    ->schema([
                        Grid::make(2)->schema([
                            DateTimePicker::make('starts_at')
                                ->label('Starts At')
                                ->required(),

                            DateTimePicker::make('ends_at')
                                ->label('Ends At')
                                ->required(),
                        ]),

                        Grid::make(2)->schema([
                            Select::make('status')
                                ->options([
                                    'active'    => 'Active',
                                    'expired'   => 'Expired',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->required()
                                ->default('active'),

                            DateTimePicker::make('cancelled_at')
                                ->label('Cancelled At')
                                ->nullable(),
                        ]),
                    ]),
            ]);
    }
}
