<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_surat',
        'kode_surat',
        'template_path',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }
}
