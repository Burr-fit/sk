<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fitur_Unlocks extends Model
{
    use HasFactory;

    protected $table = 'fitur_unlock';
    protected $primaryKey = 'idUnlock';
    public $timestamps = true;

    protected $fillable = [
        'idUnlock',
        'idAkun',
        'idFitur',
        'tanggalMulai',
        'tanggalBerakhir',
        'potonganPoint',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
