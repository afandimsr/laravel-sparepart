<?php

use App\KategoriPenjualan;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kategori = ["mobil", "sepeda motor"];
        $kategori1 = KategoriPenjualan::create([
            'nama_kategori' => $kategori[0],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),

        ]);
        $kategori2 = KategoriPenjualan::create([
            'nama_kategori' => $kategori[1],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),

        ]);
    }
}
