<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FadhilKategori;

class FadhilKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = ['Individu', 'Kelompok', 'Ujian', 'Kuis'];

        foreach ($data as $kategori) {
            FadhilKategori::create(['nama_kategori' => $kategori]);
        }
    }
}
