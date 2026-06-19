<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $kode_gejala
 * @property string $nama_gejala
 * @property float $cf_pakar
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Gejala extends Model
{
    protected $table = 'gejala';

    protected $fillable = [
        'kode_gejala',
        'nama_gejala',
        'cf_pakar',
    ];
}
