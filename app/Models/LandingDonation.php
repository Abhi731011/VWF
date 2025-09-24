<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingDonation extends Model
{
    protected $fillable = [
        'project_id',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'currency',
        'message',
        'referral_volunteer_id',
        'is_anonymous',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'status',
        'payment_details',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'payment_details' => 'array',
    ];

    /**
     * Get the project that the donation is for.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Scope to get anonymous donations.
     */
    public function scopeAnonymous($query)
    {
        return $query->where('is_anonymous', true);
    }

    /**
     * Scope to get completed donations.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope to get pending donations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get donations by referral volunteer.
     */
    public function scopeByReferralVolunteer($query, $volunteerId)
    {
        return $query->where('referral_volunteer_id', $volunteerId);
    }
}