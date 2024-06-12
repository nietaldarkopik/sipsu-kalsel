<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermukimanModel extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    use HasFactory;
    protected $table = 'permukiman'; // Nama tabel dalam database

    protected $fillable = [
        'kabkota_id',
        'kecamatan_id',
        'kelurahan_id',
        'nama_permukiman',
        'luas',
        'tahun_siteplan',
        'latitude',
        'longitude',
        'latlong',
        'total_unit',
        'no_bast',
        'file_bast',
        'created_at',
        'updated_at',
        'photo',
        'siteplan',
        'alamat',
        'user_id_create',
        'status_data',
        'user_id_update',
        'geometry',
        'geometry_file',
        'file_survey',
    ];
    
    protected $dates = ['deleted_at'];

    public function getKategori(){
        return $this->belongsTo(KategoriPsuModel::class, 'kategori');
    }
}
