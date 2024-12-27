<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'order';

    //protected $primaryKey = 'order_id';

    protected $fillable = [
        'users_id',
        'item_id',
        'quantity',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id'); // Explicitly define the pivot table name
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
