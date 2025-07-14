<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FadhilTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'deadline',
        'mata_kuliah_id',
        'kategori_id',
        'dibuat_oleh_user_id',
        'file',
    ];

    public function pengumpulanTugas()
    {
        return $this->hasMany(\App\Models\FadhilPengumpulanTugas::class, 'tugas_id');
    }

    public function mataKuliah()
        {
            return $this->belongsTo(FadhilMataKuliah::class, 'mata_kuliah_id');
        }

    public function kategori()
    {
        return $this->belongsTo(FadhilKategori::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh_user_id');
    }

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }
}
