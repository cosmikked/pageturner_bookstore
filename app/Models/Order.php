<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_amount',
        'status',
        'street',
        'baranggay',
        'city',
        'province',
        'postal_code',
        'reference_number'
    ];

    public function customer(): BelongsTo {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function orderItems(): HasMany {
        return $this->hasMany(OrderItem::class);
    }

}
