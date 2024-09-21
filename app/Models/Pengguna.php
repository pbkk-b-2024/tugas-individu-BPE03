<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';

    //protected $primaryKey = 'pengguna_id';

    protected $fillable = [
        'nama',
        'username',
        'email',
        'umur',
        'jenis_kelamin',
        'alamat',
        'no_telp',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
