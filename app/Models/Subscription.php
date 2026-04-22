<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    protected $casts = [
        'starts_at'    => 'datetime',
        'ends_at'      => 'datetime',
        'cancelled_at' => 'datetime',
        'price'        => 'decimal:2',
    ];

    /* ── Relationships ── */

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /* ── Helpers ── */

    /**
     * Whether the subscription is currently active and not expired.
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && now()->lte($this->ends_at);
    }

    /**
     * Whether the subscription has expired (past end date).
     */
    public function isExpired(): bool
    {
        return now()->gt($this->ends_at);
    }

    /**
     * Days remaining on this subscription.
     */
    public function daysRemaining(): int
    {
        return max(0, (int) now()->diffInDays($this->ends_at, false));
    }
}
