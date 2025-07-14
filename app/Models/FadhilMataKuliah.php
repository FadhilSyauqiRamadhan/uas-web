<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FadhilMataKuliah extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama_mata_kuliah', 'dosen_pengampu'];

    public function tugas()
{
    return $this->hasMany(FadhilTugas::class, 'mata_kuliah_id');
}


}

