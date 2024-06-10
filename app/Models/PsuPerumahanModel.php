<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PsuPerumahanModel extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    use HasFactory;
    protected $table = 'psu_perumahan'; // Nama tabel dalam database

    protected $fillable = [
        'jenis_perumahan','id_perumahan','id_jenis_psu','id_kategori','id_psu','nama_psu','deskripsi','bast_status','bast_file','bast_tanggal','kondisi','latitude','longitude','latlong','photo'
    ];

    
    public function getPerumahan(){
        return $this->belongsTo(PerumahanModel::class, 'id_perumahan');
    }
    
    public function getJenisPsu(){
        return $this->belongsTo(JenisPsuModel::class, 'id_jenis_psu');
    }
    
    public function getKategori(){
        return $this->belongsTo(PsuModel::class, 'id_kategori');
    }
}
