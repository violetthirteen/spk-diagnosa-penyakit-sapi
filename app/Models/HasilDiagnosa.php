<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $penyakit
 * @property float $nilai_cf
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property User $user
 */
class HasilDiagnosa extends Model
{
    protected $table = 'hasil_diagnosa';

    protected $fillable = [
        'user_id',
        'penyakit',
        'nilai_cf',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
