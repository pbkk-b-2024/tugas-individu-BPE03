<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    //protected $primaryKey = 'order_id';

    protected $fillable = [
        'nama',
        'total',
        'items',
        'status',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_item','order_id', 'item_id'); // Explicitly define the pivot table name
    }

    public function penggunas()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
