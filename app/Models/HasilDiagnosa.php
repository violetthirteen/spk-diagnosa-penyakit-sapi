<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilDiagnosa extends Model
{
    protected $table = 'hasil_diagnosa';

    protected $fillable = [
        'user_id',
        'penyakit',
        'nilai_cf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
