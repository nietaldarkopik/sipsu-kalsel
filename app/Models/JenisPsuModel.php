<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPsuModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'jenis_psu'; // Nama tabel dalam database

    protected $fillable = [
        'kategori','title','deskripsi',
    ];
    public function getKategori(){
        return $this->belongsTo(KategoriPsuModel::class, 'kategori');
    }
}
