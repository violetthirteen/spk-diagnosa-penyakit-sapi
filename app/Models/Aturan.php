<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    protected $table = 'aturan';

    protected $fillable = [
        'penyakit_id',
        'gejala_id',
        'solusi_id',
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }

    public function solusi()
    {
        return $this->belongsTo(Solusi::class);
    }
}
