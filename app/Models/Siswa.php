<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'jurusan_id',
    ];

    // relasi: satu siswa bisa punya banyak surat dispensasi
    public function suratDispensasi()
    {
        return $this->hasMany(SuratDispensasi::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }


    public function masihDispen()
    {
        $suratTerakhir = $this->suratDispensasi()
            ->latest('created_at')
            ->first();

        if (!$suratTerakhir) {
            return false;
        }

        return $suratTerakhir->statusTerakhir() === 'dispen';
    }
}
