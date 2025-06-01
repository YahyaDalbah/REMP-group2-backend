<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_id',
        'title',
        'image',
        'images',
        'location',
        'description',
        'bedrooms',
        'bathrooms',
        'price',
        'isForRent',
        'isForSale',
        'status',
    ];

    protected $casts = [
        'isForRent' => 'boolean',
        'isForSale' => 'boolean',
        'images' => 'array'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}