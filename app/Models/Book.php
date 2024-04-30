<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'writer',
        'cover_image',
        'point',
        'tags',
    ];
    
    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }
}
