<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CertificateRequest extends Model
{
    protected $fillable = [
        'certificate_id',
        'user_id',
        'full_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'image_path',
        'status',
        'admin_notes',
        'rejection_reason',
        'approved_at',
        'rejected_at',
        'approved_by',
        'rejected_by',
        'certificate_path',
        'certificate_design_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /**
     * Get the user that owns the certificate request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who approved the certificate request.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the admin who rejected the certificate request.
     */
    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Get the certificate design used for this request.
     */
    public function certificateDesign(): BelongsTo
    {
        return $this->belongsTo(CertificateDesign::class);
    }

    /**
     * Generate a unique certificate ID.
     */
    public static function generateCertificateId(): string
    {
        do {
            $certificateId = 'VWF-' . date('Y') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('certificate_id', $certificateId)->exists());

        return $certificateId;
    }

    /**
     * Boot method to auto-generate certificate ID.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificateRequest) {
            if (empty($certificateRequest->certificate_id)) {
                $certificateRequest->certificate_id = self::generateCertificateId();
            }
        });
    }
}
