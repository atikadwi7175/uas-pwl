<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'harga',
        'gambar',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
