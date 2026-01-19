<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratDispensasi extends Model
{
    use SoftDeletes;
    protected $table = 'surat_dispensasi';

    protected $fillable = [
        'siswa_id',
        'jenis_surat_id',
        'tanggal_mulai',
        'kembali_pelajaran_ke',
        'waktu_kembali_batas',
        'alasan',
    ];

    // relasi ke siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // relasi ke jenis surat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class);
    }
    public function logs()
    {
        return $this->hasMany(LogDispensasi::class, 'surat_dispensasi_id');
    }

    public function statusTerakhir()
    {
        return $this->logs()
            ->latest('waktu')
            ->value('status') ?? 'dispen';
    }
}
