<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota_Keluarga extends Model
{
    use HasFactory;

    protected $table = 'anggota_keluarga';
    protected $primaryKey = 'idAnggotaKeluarga';
    public $timestamps = true;

    protected $fillable = [
        'idAnggotaKeluarga',
        'idOrang',
        'idKeluarga',
        'idAkun',
        'deskripsi',
        'katagoriAkses',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
