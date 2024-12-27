<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist';

    protected $fillable = [
        'users_id',
        'items',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'wishlist_item', 'wishlist_id', 'item_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
