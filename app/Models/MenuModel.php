<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'menus'; // Nama tabel dalam database

    protected $fillable = [
        "id","menu_group_id","parent_id","code","title"
    ];
}
