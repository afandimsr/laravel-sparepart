<?php

namespace App\Http\Controllers;

use App\Barang;
use App\KategoriPenjualan;
use App\Peminjaman;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $barangs = Barang::all();
        $kategoris = KategoriPenjualan::all();
        return view("admin/barang/index", compact("barangs", "kategoris"));
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
        $request->validate([
            'nama_barang' => 'required|unique:barangs,nama_barang',
            'harga_jual' => 'required',
            'harga_beli' => 'required',
            'satuan' => 'required',
            'kategori' => 'required',
            // '' => 'required',

        ], [
            'nama_barang.required' => "Nama alat/barang tidak boleh kosong",
            // 'jumlah.required' => "Jumlah alat/barang tidak",
            "nama_barang.unique" => "Nama Barang Sudah Ada, silahkan periksa kembali",
        ]);
        // dd($request->file("gambar"));
        if ($request->file("gambar") != null) {
            $request->validate([

                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',

            ], ["gambar.max" => "* Ukuran gambar kurang dari 1 MB"]);
            $path = "img/barang/";
            $file = $request->file('gambar');
            $newFileName = $request->nama_barang . "." . $file->getClientOriginalExtension();
            $upload = $file->move($path, $newFileName);
            if ($upload) {
                $barang = Barang::create([
                    "nama_barang" => $request->nama_barang,
                    "harga_jual" => $request->harga_jual,
                    "harga_beli" => $request->harga_beli,
                    "kategori" => $request->kategori,
                    "satuan" => $request->satuan,
                    "gambar" => $newFileName,
                ]);

                if ($barang) {
                    return redirect()->route("admin.manajemen_barang.index")->with([
                        'message' => 'Gambar Barang  Berhasil upload !',
                        'alert' => 'alert-success',
                    ]);
                } else {
                    return redirect()->route("admin.manajemen_barang.index")->with([
                        'message' => 'Gambar Barang Gagal diupload !',
                        'alert' => 'alert-danger',
                    ]);
                }
            }
        } elseif ($request->file("gambar") == null) {
            $barang = Barang::create([
                "nama_barang" => $request->nama_barang,
                "harga_jual" => $request->harga_jual,
                "harga_beli" => $request->harga_beli,
                "kategori" => $request->kategori,
                "satuan" => $request->satuan,
                "gambar" => "default.jpg",
            ]);

            if ($barang) {
                return redirect()->route("admin.manajemen_barang.index")->with([
                    'message' => 'Barang  Berhasil Ditambahkan!',
                    'alert' => 'alert-success',
                ]);
            } else {
                return redirect()->route("admin.manajemen_barang.index")->with([
                    'message' => 'Barang Gagal Ditambahkan !',
                    'alert' => 'alert-danger',
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $barang = Barang::findOrFail($id);
        $kategoris = KategoriPenjualan::all();
        // dd($kategoris);
        if ($barang) {
            return view("admin.barang.edit", compact("barang", "kategoris"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $barang = Barang::FindOrFail($id);
        if ($barang != null) {
            if ($request->file("gambar") != null) {
                $request->validate([

                    'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:800',

                ], ["gambar.max" => "* Ukuran gambar kurang dari 800 kb"]);
                $path = "img/barang/";
                $file = $request->file('gambar');
                $newFileName = $request->nama_barang . "." . $file->getClientOriginalExtension();
                $upload = $file->move($path, $newFileName);
                if ($upload) {
                    $barang = Barang::where('id', $id)->update(array(
                        'gambar' => $newFileName,
                        'nama_barang' => $request->nama_barang,
                        'harga_jual' => $request->harga_jual,
                        'harga_beli' => $request->harga_beli,
                        'satuan' => $request->satuan,
                        'kategori' => $request->kategori,

                    ));
                    if ($barang) {
                        return redirect()->route("admin.manajemen_barang.index")->with([
                            'message' => 'Data Barang Berhasil dirubah !',
                            'alert' => 'alert-success',
                        ]);
                    } else {
                        return redirect()->route("admin.manajemen_barang.index")->with([
                            'message' => 'Data Barang Gagal dirubah !',
                            'alert' => 'alert-danger',
                        ]);
                    }
                }
            } else if ($request->file("gambar") == null) {
                // dd($request);

                $request->validate([
                    'nama_barang' => 'required',
                    'harga_jual' => 'required',
                    'harga_beli' => 'required',
                    'satuan' => 'required',
                    'kategori' => 'required',

                ], ["nama_barang.required" => "Nama Alat Tidak Boleh Kosong !", "jumlah.required" => "Jumlah Barang Tidak Boleh Kosong"]);
                $barang = Barang::where('id', $id)->update(array(
                    'nama_barang' => $request->nama_barang,
                    'harga_jual' => $request->harga_jual,
                    'harga_beli' => $request->harga_beli,
                    'satuan' => $request->satuan,
                    'kategori' => $request->kategori,
                ));
                if ($barang) {

                    return redirect()->route("admin.manajemen_barang.index")->with([
                        'message' => 'Barang Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                } else {
                    return redirect()->route("admin.manajemen_barang.index")->with([
                        'message' => 'Barang Gagal dirubah !',
                        'alert' => 'alert-danger',
                    ]);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        if ($barang) {
            return redirect()->route("admin.manajemen_barang.index")->with([
                "message" => "Data Berhasil Dihapus",
                "alert" => "alert-success",
            ]);
        } else {
            return redirect()->route("admin.manajemen_barang.index")->with([
                "message" => "Data Gagal Dihapus Dihapus",
                "alert" => "alert-danger",
            ]);
        }
    }
}
