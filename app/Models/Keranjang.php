<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = [
        'users_id',
        'items',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'keranjang_item', 'keranjang_id', 'item_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
