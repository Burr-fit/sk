<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langganans extends Model
{
    use HasFactory;

    protected $table = 'langganan';
    protected $primaryKey = 'idLangganan';
    public $timestamps = true;

    protected $fillable = [
        'idLangganan',
        'idFitur',
        'idAkun',
        'idPromo',
        'idPaket',
        'tanggalMulai',
        'tanggalberakhir',
        'status',
        'metodeBayar',
        'invoice',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
