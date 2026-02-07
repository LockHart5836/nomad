<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'seats',
        'transmission',
        'features',
        'image',
        'available',
        'description',
    ];

    protected $casts = [
        'available' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('available', true);
    }

    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
