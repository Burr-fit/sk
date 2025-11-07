<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ceritas extends Model
{
    use HasFactory;

    protected $table = 'cerita';
    protected $primaryKey = 'idCerita';
    public $timestamps = true;

    protected $fillable = [
        'idCerita',
        'idOrang',
        'judulCerita',
        'isiCerita',
        'katagoriMoment',
        'fileMoment',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
