<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar_Ceritas extends Model
{
    use HasFactory;

    protected $table = 'komentar_cerita';
    protected $primaryKey = 'idKomentar';
    public $timestamps = true;

    protected $fillable = [
        'idKomentar',
        'idCerita',
        'idOrang',
        'isiKomentar',
        'perentIdKomentar',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
