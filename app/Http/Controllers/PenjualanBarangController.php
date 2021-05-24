<?php

namespace App\Http\Controllers;

use App\Barang;
use App\PenjualanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo "page under maintenance";
        $barangs = Barang::all();
        $penjualans = DB::table('penjualan_barangs')
            ->leftJoin('barangs', 'penjualan_barangs.id_barang', '=', 'barangs.id')
            ->leftJoin('kategori_penjualans', 'barangs.kategori', '=', 'kategori_penjualans.id')

            ->get();
        // dd($penjualans);
        return view("admin.penjualan.index", compact("penjualans", "barangs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $request->validate([
            'nama_konsumen' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required',

            // 'tanggal_faktur' => 'required',
            // '' => 'required',

        ], [
            'id_barang.required' => "Nama barang tidak boleh kosong",
            // 'jumlah.required' => "Jumlah alat/barang tidak",
            // "nama_barang.unique" => "Nama Barang Sudah Ada, silahkan periksa kembali",
        ]);
        $penjualan = PenjualanBarang::create([
            "nama_konsumen" => $request->nama_konsumen,
            "id_barang" => $request->id_barang,
            "jumlah" => $request->jumlah,
            "created_at" => Carbon::now()->toDateTimeString(),
        ]);

        if ($penjualan) {
            return redirect()->route("admin.penjualan_barang.index")->with([
                'message' => 'Penjulan Barang Berhasil Ditambahkan!',
                'alert' => 'alert-success',
            ]);
        } else {
            return redirect()->route("admin.penjulan_barang.index")->with([
                'message' => 'Barang Barang Gagal Ditambahkan !',
                'alert' => 'alert-danger',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PenjualanBarang  $penjualanBarang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PenjualanBarang  $penjualanBarang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $penjualan = DB::table('penjualan_barangs')
            ->join('barangs', 'penjualan_barangs.id_barang', '=', 'barangs.id')
            ->join('kategori_penjualans', 'barangs.kategori', '=', 'kategori_penjualans.id')
            ->where("penjualan_barangs.id_penjualan", $id)
            ->get()->first();
        $barangs = Barang::all();
        // dd($id);
        // dd($penjualan);
        // $penjualan = PenjualanBarang::findOrFail($id);
        return view("admin.penjualan.edit", compact("penjualan", "barangs"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PenjualanBarang  $penjualanBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'id_barang' => 'required',
            'nama_konsumen' => 'required',
            'jumlah' => 'required',


        ], ["id_barang.required" => "Nama Alat Tidak Boleh Kosong !", "jumlah.required" => "Jumlah Tidak Boleh Kosong"]);
        $penjualan = PenjualanBarang::where('id_penjualan', $id)->update(array(
            'nama_konsumen' => $request->nama_konsumen,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            // 'satuan' => $request->satuan,
            // 'kategori' => $request->kategori,
        ));
        if ($penjualan) {

            return redirect()->route("admin.penjualan_barang.index")->with([
                'message' => 'Data Penjualan Barang Berhasil dirubah !',
                'alert' => 'alert-success',
            ]);
        } else {
            return redirect()->route("admin.penjualan_barang.index")->with([
                'message' => 'Data Penjualan Barang Gagal dirubah !',
                'alert' => 'alert-danger',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PenjualanBarang  $penjualanBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $barang = PenjualanBarang::find($id);
        $barang->delete();
        if ($barang) {
            return redirect()->route("admin.penjualan_barang.index")->with([
                "message" => "Data Penjualan Berhasil Dihapus",
                "alert" => "alert-success",
            ]);
        } else {
            return redirect()->route("admin.penjualan_barang.index")->with([
                "message" => "Data Penjualan Gagal Dihapus Dihapus",
                "alert" => "alert-danger",
            ]);
        }
    }
}
