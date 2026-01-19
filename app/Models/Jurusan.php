<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'jurusans';

    protected $fillable = [
        'nama',
    ];

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}
