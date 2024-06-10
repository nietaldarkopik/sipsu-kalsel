<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenKotaModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'regencies'; // Nama tabel dalam database

    public function __construct()
    {
        parent::where('province_id', 63);
    }
    protected $fillable = [
        'province_id',
        'name',
        'alt_name',
        'latitude',
        'longitude',
    ];
}
