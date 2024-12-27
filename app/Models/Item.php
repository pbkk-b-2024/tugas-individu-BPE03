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
        'users_id',    
    ];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'item_kategori','item_id', 'kategori_id'); // Explicitly define the pivot table name
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function keranjangs()
    {
        return $this->belongsToMany(Keranjang::class, 'keranjang_item', 'item_id', 'keranjang_id');
    }

    public function wishlists()
    {
        return $this->belongsToMany(Wishlist::class, 'wishlist_item', 'item_id', 'wishlist_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
