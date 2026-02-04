<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
      'order_id',
      'book_id',
      'quantity',
      'unit_price'
    ];
    public function book(): BelongsTo {
        return $this->belongsTo(Book::class);
    }

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }

    public function getSubtotal(): float {
        return $this->quantity * $this->unit_price;
    }
}
