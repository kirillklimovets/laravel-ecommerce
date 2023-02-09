<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    public const INDEX_NAME = 'products_index';

    public static function getIndexName(): string
    {
        return self::INDEX_NAME;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getPriceAsFloat(): float
    {
        return $this->price / 100;
    }

    public function searchableAs(): string
    {
        return self::INDEX_NAME;
    }

    public function toSearchableArray(): array
    {
        $this->categories();

        $array = $this->toArray();

        $array = $this->transform($array);

        $array['categories'] = $this->categories->map(fn($category) => $category->name)->toArray();

        return $array;
    }
}
