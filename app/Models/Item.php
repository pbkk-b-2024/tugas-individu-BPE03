<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Item extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'item';

    //protected $primaryKey = 'item_id';

    protected $fillable = [
        'nama',           
        'kategori',         
        'harga',
        'stok',        
        'deskripsi',
        'image',    
    ];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'item_kategori','item_id', 'kategori_id'); // Explicitly define the pivot table name
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_item','item_id', 'order_id'); // Explicitly define the pivot table name
    }

    public function reviews()
    {
        return $this->hasMany(Review::class); // Explicitly define the pivot table name
    }

}
