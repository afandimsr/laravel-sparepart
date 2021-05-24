<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    protected $fillable = ["nama_barang", "harga_jual", "harga_beli", "kategori", "satuan", "gambar"];
}
