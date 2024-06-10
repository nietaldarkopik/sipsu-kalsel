<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelurahanModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'villages'; // Nama tabel dalam database

    public function __construct(){
        $this->where('province_id',63);
    }
    protected $fillable = [
        'district_id','name','alt_name','latitude','longitude'
    ];

    public function getKabupatenKota(){
        return $this->belongsTo(KabupatenKotaModel::class, 'regency_id');
    }

    public function getKecamatan(){
        return $this->belongsTo(KecamatanModel::class, 'district_id');
    }
}