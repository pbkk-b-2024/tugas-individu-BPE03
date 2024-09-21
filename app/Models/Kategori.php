<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Kategori extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'kategori';

    //protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_kategori', 'kategori_id', 'item_id'); // Explicitly define the pivot table name
    }

    
}
