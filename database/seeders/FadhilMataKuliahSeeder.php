<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FadhilMataKuliah;

class FadhilMataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
            $data = [
            ['nama' => 'Pemrograman Web', 'dosen' => 'Budi'],
            ['nama' => 'Basis Data', 'dosen' => 'Siti'],
            ['nama' => 'Jaringan Komputer', 'dosen' => 'Andi'],
        ];

        foreach ($data as $i => $mk) {
            FadhilMataKuliah::create([
                'kode' => 'MK' . str_pad($i + 1, 2, '0', STR_PAD_LEFT),
                'nama_mata_kuliah' => $mk['nama'],
                'dosen_pengampu' => $mk['dosen'],
            ]);
        }
    }
}
