<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FadhilPengumpulanTugas extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tugas_id', 'file_tugas', 'tanggal_kumpul'];

    public function tugas()
    {
        return $this->belongsTo(FadhilTugas::class, 'tugas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

