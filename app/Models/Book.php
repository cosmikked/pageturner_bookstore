<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'isbn',
        'price',
        'stock_quantity',
        'description',
        'cover_image_url'
    ];
    public function category(): BelongsTo {
        return $this->belongsTo(Book::class);
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

    public function authors(): BelongsToMany {
        return $this->belongsToMany(Author::class);
    }

    public function getAverageRating(): float {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
