<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name'
    ];

    public function books(): BelongsToMany {
        return $this->belongsToMany(Book::class);
    }

    public function getFullName(): string {
        return $this->last_name . " " . $this->first_name . ", " . $this->middle_name;
    }
}
