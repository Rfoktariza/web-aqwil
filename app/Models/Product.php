<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'stock',
        'specs',
        'status'
    ];

    protected $casts = [
        'specs' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    // Scope untuk produk yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }



}
