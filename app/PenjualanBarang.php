<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenjualanBarang extends Model
{
    //
    protected $primaryKey = "id_penjualan";
    protected $fillable = ["nama_konsumen", "id_barang", "jumlah"];
}
