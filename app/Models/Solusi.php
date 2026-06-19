<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $kode_solusi
 * @property string $deskripsi_solusi
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Solusi extends Model
{
    protected $table = 'solusi';

    protected $fillable = [
        'kode_solusi',
        'deskripsi_solusi',
    ];
}
