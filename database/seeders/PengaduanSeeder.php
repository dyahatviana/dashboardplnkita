<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaduan; // Panggil model Pengaduan
use Carbon\Carbon;       // Panggil Carbon untuk konversi format tanggal

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Tentukan lokasi file CSV
        $filePath = storage_path("app/data dummy.csv");

        // 2. Buka file CSV untuk dibaca ("r" = read)
        $csvFile = fopen($filePath, "r");

        // 3. Buat penanda untuk melewati baris pertama (Header kolom)
        $isFirstLine = true;

        // 4. Looping untuk membaca isi CSV baris demi baris
        while (($data = fgetcsv($csvFile, 1000, ",")) !== FALSE) {

            // Lewati baris pertama karena itu adalah nama kolom (id_pengaduan, dll)
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            // 5. Masukkan data ke dalam tabel pengaduans
            Pengaduan::create([
                'id_pengaduan'        => $data[0], // Kolom 1 di CSV
                'tanggal_masuk'       => Carbon::parse($data[1])->format('Y-m-d'), // Kolom 2 di CSV diubah formatnya
                'jenis_pengaduan'     => $data[2], // Kolom 3 di CSV
                'wilayah'             => $data[3], // Kolom 4 di CSV
                'status_penyelesaian' => $data[4], // Kolom 5 di CSV
            ]);
        }

        // 6. Tutup file setelah selesai dibaca
        fclose($csvFile);
    }
}
