<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPsuModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'kategori_psu'; // Nama tabel dalam database

    protected $fillable = [
        'title','deskripsi',
    ];
}
