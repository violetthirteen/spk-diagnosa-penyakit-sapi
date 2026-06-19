<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    protected $table = 'solusi';

    protected $fillable = [
        'kode_solusi',
        'deskripsi_solusi',
    ];
}
