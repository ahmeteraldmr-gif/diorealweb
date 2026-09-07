<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'start_date',
        'end_date',
        'next_payment_date',
        'is_active',
        'is_trial',
        'student_limit',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'next_payment_date' => 'date',
            'is_active' => 'boolean',
            'is_trial' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    public function getRemainingDaysAttribute(): int
    {
        if (!$this->end_date) {
            return 0;
        }
        return (int) \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($this->end_date)->startOfDay(), false);
    }

    public function getRemainingTimeTextAttribute(): string
    {
        if (!$this->is_active || !$this->end_date) {
            return '🔴 Süresi Doldu';
        }

        $endOfDay = \Carbon\Carbon::parse($this->end_date)->endOfDay();
        $now = \Carbon\Carbon::now();

        if ($endOfDay->isPast()) {
            return '🔴 Süresi Doldu';
        }

        $days = (int) \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($this->end_date)->startOfDay(), false);

        if ($days >= 1) {
            return '🟢 ' . $days . ' gün kaldı';
        }

        $diff = $now->diff($endOfDay);
        $hours = $diff->h;
        $minutes = $diff->i;

        if ($hours > 0 && $minutes > 0) {
            return '🟢 ' . $hours . ' saat ' . $minutes . ' dakika kaldı';
        } elseif ($hours > 0) {
            return '🟢 ' . $hours . ' saat kaldı';
        } elseif ($minutes > 0) {
            return '🟢 ' . $minutes . ' dakika kaldı';
        } else {
            return '🟢 Son dakikalar';
        }
    }
}
