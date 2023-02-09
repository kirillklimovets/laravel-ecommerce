<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryProduct extends Pivot
{
    use HasFactory;

    protected $table = 'category_product';
    protected $fillable = ['product_id', 'category_id'];

    public static function boot(): void
    {
        parent::boot();

        static::saved(function ($model) {
            Product::find($model->product_id)->touch();
        });

        static::deleted(function ($item) {
            Product::find($item->product_id)->touch();
        });
    }
}
