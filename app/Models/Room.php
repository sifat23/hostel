<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;


    public function hostel(): BelongsTo
    {
        return $this->belongsTo(Hostel::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
