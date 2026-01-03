<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'email_verification_token',
        'email_verification_token_expires_at',
        'email_verified_at'
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
        ];
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>', now());
            })
            ->latest();
    }

    public function currentPlan(): string
    {
        return $this->activeSubscription?->plan_tier ?? 'free';
    }

    public function maxBuckets(): int
    {
        return match($this->currentPlan()) {
            'basic' => 10,
            'pro' => 25,
            'enterprise' => 999999,
            default => 2,
        };
    }

    public function maxStorageBytes(): int
    {
        return match($this->currentPlan()) {
            'basic' => 100 * 1024 * 1024 * 1024,
            'pro' => 500 * 1024 * 1024 * 1024,
            'enterprise' => 2 * 1024 * 1024 * 1024 * 1024,
            default => 5 * 1024 * 1024 * 1024,
        };
    }

    public function allowedBucketTypes(): array
    {
        return match($this->currentPlan()) {
            'basic' => ['standard', 'archival'],
            'pro', 'enterprise' => ['standard', 'archival', 'deep_archive'],
            default => ['standard'],
        };
    }

    public function totalStorageUsed(): float
    {
        return $this->items()
                ->where('is_folder', false)
                ->sum('size')
            / (1024 ** 3);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verification_token_expires_at' => 'datetime',
    ];

    public function buckets(): HasMany
    {
        return $this->hasMany(Bucket::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
