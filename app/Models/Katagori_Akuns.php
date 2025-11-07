<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katagori_Akuns extends Model
{
    use HasFactory;

    protected $table = 'katagori_akun';
    protected $primaryKey = 'idKatagori';
    public $timestamps = true;

    protected $fillable = [
        'idKatagori',
        'jenisKatagori',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
