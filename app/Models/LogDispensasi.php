<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogDispensasi extends Model
{
    protected $table = 'log_dispensasi';

    protected $fillable = [
        'surat_dispensasi_id',
        'status',
        'waktu',
        'catatan',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    public function suratDispensasi()
    {
        return $this->belongsTo(SuratDispensasi::class, 'surat_dispensasi_id');
    }
}
