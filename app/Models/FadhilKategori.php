<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FadhilKategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori'];

    // Tambahkan relasi hasMany ke FadhilTugas
    public function tugas()
        {
            return $this->hasMany(FadhilTugas::class, 'kategori_id');
        }
}
