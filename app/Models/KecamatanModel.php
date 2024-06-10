<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KecamatanModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'districts'; // Nama tabel dalam database

    public function __construct(){
        $this->where('province_id',63);
    }
    protected $fillable = [
        'regency_id','name','alt_name','latitude','longitude'
    ];

    public function getKabupatenKota(){
        return $this->belongsTo(KabupatenKotaModel::class, 'regency_id');
    }
}