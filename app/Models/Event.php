<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'category_id',
        'tags',
        'banners',
        'event_date',
        'event_time',
        'venue',
        'location',
        'about_event',
        'agenda',
        'organizer_name',
        'contact_email',
        'contact_phone',
        'status',
        'is_featured',
        'visibility',
        'max_attendees',
        'registration_required',
        'registration_deadline',
        'documents',
        'speakers',
        'sponsors',
    ];

    protected $casts = [
        'tags' => 'array',
        'banners' => 'array',
        'documents' => 'array',
        'speakers' => 'array',
        'sponsors' => 'array',
        'is_featured' => 'boolean',
        'visibility' => 'boolean',
        'registration_required' => 'boolean',
        'event_date' => 'date',
        'registration_deadline' => 'date',
        'max_attendees' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
