<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiturs extends Model
{
    use HasFactory;

    protected $table = 'fitur';
    protected $primaryKey = 'idFitur';
    public $timestamps = true;

    protected $fillable = [
        'idFitur',
        'idKatagori',
        'namaFitur',
        'deskripsi',
        'pontFitur',
        'durasiHari',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
