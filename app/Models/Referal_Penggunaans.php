<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referal_Penggunaans extends Model
{
    use HasFactory;

    protected $table = 'referal_penggunaan';
    protected $primaryKey = 'idPenggunaan';
    public $timestamps = true;

    protected $fillable = [
        'idPenggunaan',
        'idReferal',
        'idPemberi',
        'idPenggunabaru',
        'jumlahPoint',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
