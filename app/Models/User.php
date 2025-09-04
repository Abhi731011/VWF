<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_id',
        'profile_img',
        'banner_img',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'package_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'admin_id' => 'integer',
            'package_id' => 'integer',
        ];
    }

    /**
     * Get the package that the user belongs to.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Check if the user is the main admin.
     */
    public function isMainAdmin()
    {
        return $this->email === 'admin@gmail.com';
    }
}
