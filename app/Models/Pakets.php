<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakets extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'idPaket';
    public $timestamps = true;

    protected $fillable = [
        'idPaket',
        'namaPaket',
        'harga',
        'durasiHari',
        'deskripsi',
        'fiturLimit',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
