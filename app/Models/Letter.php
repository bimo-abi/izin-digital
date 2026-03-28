<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'purpose',
        'status',
        'verified_by',
        'verified_at',
        'rejection_notes',
        'file_path',
        'verification_code',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    // Relasi ke User (Mahasiswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke LetterTemplate
    public function template()
    {
        return $this->belongsTo(LetterTemplate::class);
    }

    // Relasi ke User (Admin yang verifikasi)
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
