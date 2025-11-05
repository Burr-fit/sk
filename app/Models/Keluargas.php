<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangs extends Model
{
    use HasFactory;

    protected $table = 'orang';
    protected $primaryKey = 'idOrang';
    public $timestamps = true;

    protected $fillable = [
        'idKeluarga',
        'namaOrang',
        'tempatLahir',
        'jenisKelamin',
        'noTelphone',
        'lokasiTinggal',
        'tanggalWafat',
        'lokasiPemakaman',
        'foto',
    ];
}
