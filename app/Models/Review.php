<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    //protected $primaryKey = 'review_id';

    protected $fillable = [
        'nama',
        'item',
        'rating',
        'review',
    ];

    public function penggunas()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
