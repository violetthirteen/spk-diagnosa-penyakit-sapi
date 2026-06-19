<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $penyakit_id
 * @property int $gejala_id
 * @property int $solusi_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property Penyakit $penyakit
 * @property Gejala $gejala
 * @property Solusi $solusi
 */
class Aturan extends Model
{
    protected $table = 'aturan';

    protected $fillable = [
        'penyakit_id',
        'gejala_id',
        'solusi_id',
    ];

    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class);
    }

    public function solusi(): BelongsTo
    {
        return $this->belongsTo(Solusi::class);
    }
}
