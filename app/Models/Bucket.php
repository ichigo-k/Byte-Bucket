<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bucket extends Model
{
    use HasUuids;


    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function sizeInGb(): float
    {
        $bytes = $this->items()
            ->where('is_folder', false)
            ->sum('size');

        return $bytes > 0 ? round($bytes / (1024 ** 3), 2) : 0.00;
    }

}
