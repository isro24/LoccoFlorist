<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'status',
        'is_best_seller',
        'admin_id',
        'category_id',
        'slug'
    ];

    public function category()
    {
        return $this->belongsTo(Category ::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function images()
    {
        return $this->hasMany(AdditionalImage::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = $product->slug ?: Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = $product->slug ?: Str::slug($product->name);
        });
    }
}
