<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anaks extends Model
{
    use HasFactory;

    protected $table = 'anak';
    protected $primaryKey = 'idAnak';
    public $timestamps = true;

    protected $fillable = [
        'idAnak',
        'idOrang',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
