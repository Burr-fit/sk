<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referal_Kodes extends Model
{
    use HasFactory;

    protected $table = 'referal_kode';
    protected $primaryKey = 'idReferal';
    public $timestamps = true;

    protected $fillable = [
        'idReferal',
        'idAkun',
        'kodeReferal',
        'totalPenggunaan',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
