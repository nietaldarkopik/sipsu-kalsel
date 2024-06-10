<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerumahanModel extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    use HasFactory;
    protected $table = 'perumahan'; // Nama tabel dalam database

    protected $fillable = [
        'kabkota_id',
        'kecamatan_id',
        'kelurahan_id',
        'pengembang_id',
        'nama_perumahan',
        'luas',
        'tahun_siteplan',
        'latitude',
        'longitude',
        'latlong',
        'total_unit',
        'jumlah_mbr',
        'jumlah_nonmbr',
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
        'nama_pengembang',
        'telepon_pengembang',
        'email_pengembang',
        'jumlah_proses',
        'jumlah_ditempati',
        'jumlah_kosong',
        'geometry',
        'geometry_file',
        'file_survey',
    ];
    
    protected $dates = ['deleted_at'];

    public function getKategori(){
        return $this->belongsTo(KategoriPsuModel::class, 'kategori');
    }
}
