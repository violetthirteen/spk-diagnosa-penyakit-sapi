<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $kode_penyakit
 * @property string $nama_penyakit
 * @property string $deskripsi
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Penyakit extends Model
{
    protected $table = 'penyakit';

    protected $fillable = [
        'kode_penyakit',
        'nama_penyakit',
        'deskripsi',
    ];
}
