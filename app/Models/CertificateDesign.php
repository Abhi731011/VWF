<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CertificateDesign extends Model
{
    protected $fillable = [
        'name',
        'description',
        'organization_name',
        'organization_logo',
        'signature_image',
        'signature_name',
        'signature_title',
        'background_color',
        'border_color',
        'text_color',
        'title_color',
        'organization_color',
        'border_width',
        'font_family',
        'title_font_size',
        'name_font_size',
        'organization_font_size',
        'signature_font_size',
        'custom_css',
        'is_active',
        'is_default',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'border_width' => 'integer',
        'title_font_size' => 'integer',
        'name_font_size' => 'integer',
        'organization_font_size' => 'integer',
        'signature_font_size' => 'integer',
    ];

    /**
     * Get the certificate requests using this design.
     */
    public function certificateRequests(): HasMany
    {
        return $this->hasMany(CertificateRequest::class);
    }

    /**
     * Scope to get only active designs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get the default design.
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
