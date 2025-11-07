<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akuns extends Model
{
    use HasFactory;

    protected $table = 'akun';
    protected $primaryKey = 'idAkun';
    public $timestamps = true;

    protected $fillable = [
        'idAkun',
        'idKatagori',
        'email',
        'password',
        'namaLengkap',
        'fotoProfil',
        'statusUnlock',
        'totalPoint',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
