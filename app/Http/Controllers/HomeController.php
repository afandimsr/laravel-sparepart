<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Barang;
use App\PenjualanBarang;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }
    public function adminDashboard()
    {
        // dd("hello");
        $countBarangs = Barang::all()->count();
        $countPenjualans = PenjualanBarang::all()->count();
        // dd($countBarangs);
        return view('dashboard', compact("countBarangs", "countPenjualans"));
    }


    public function myProfil()
    {
        return view("/profil");
    }
    public function myProfilUpdate(Request $request)
    {

        if ($request->file("profile")) {
            $request->validate([

                'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:800',

            ], ["profile.max" => "* Ukuran gambar kurang dari 800 kb"]);
            $path = "img/profil/";
            $file = $request->file('profile');
            $newFileName = Auth::user()->cd_user . "." . $file->getClientOriginalExtension();
            $upload = $file->move($path, $newFileName);
            if ($upload) {
                $user = User::where('id', Auth::user()->id)->update(array('foto_profil' => $newFileName));
                if ($user) {


                    if (Auth::user()->getRoleNames()[0] == "pengelola") {
                        return redirect()->route("admin.profil")
                            ->with([
                                'message' => 'Gambar Profil Berhasil dirubah !',
                                'alert' => 'alert-success',
                            ]);
                    } elseif (Auth::user()->getRoleNames()[0] == "dosen") {
                        return redirect()->route("dosen.profil")
                            ->with([
                                'message' => 'Gambar Profil Berhasil dirubah !',
                                'alert' => 'alert-success',
                            ]);
                    } elseif (Auth::user()->getRoleNames()[0] == "mahasiswa") {
                        return redirect()->route("mahasiswa.profil")
                            ->with([
                                'message' => 'Gambar Profil Berhasil dirubah !',
                                'alert' => 'alert-success',
                            ]);
                    }
                } else {
                    return redirect('/admin/profil')->with([
                        'message' => 'Gambar Profil Gagal dirubah !',
                        'alert' => 'alert-danger',
                    ]);
                }
            }
        } else if ($request->input("password")) {
            $request->validate([
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6'
            ], ["password.same" => "Password tidak cocok !", "password.min" => "Password minimal 6 karakter! "]);
            $user = User::where('id', Auth::user()->id)->update(array('password' => Hash::make($request->password)));
            if ($user) {

                if (Auth::user()->getRoleNames()[0] == "pengelola") {
                    return redirect()->route("admin.profil")->with([
                        'message' => 'Password Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                } elseif (Auth::user()->getRoleNames()[0] == "dosen") {
                    return redirect()->route("dosen.profil")->with([
                        'message' => 'Password Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                } else {
                    return redirect()->route("mahasiswa.profil")->with([
                        'message' => 'Password Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                }
            } else {
                return redirect('/mahasiswa/profil')->with([
                    'message' => 'Password Gagal dirubah !',
                    'alert' => 'alert-danger',
                ]);
            }
        } else {
            $request->validate([
                "nama" => "required",
                "cd_user" => "required",
                "email" => "required|email",
                "no_hp" => "required",
            ], ["cd_user.required" => "NIM/NIP tidak boleh kosong !", "email.required" => "Email tidak boleh kosong", "no_hp.required" => "No Hp tidak boleh kosong !"]);
            $user = User::where('id', Auth::user()->id)->update([
                "name" => $request->nama,
                "cd_user" => $request->cd_user,
                "email" => $request->email,
                "no_hp" => $request->no_hp,
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
            if ($user) {
                if (Auth::user()->role == 1) {
                    return redirect()->route("admin.profil")->with([
                        'message' => 'Data Profil Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                } elseif (Auth::user()->role == 2) {
                    return redirect()->route("dosen.profil")->with([
                        'message' => 'Data Profil Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                } else {
                    return redirect()->route("mahasiswa.profil")->with([
                        'message' => 'Data Profil Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                }
            } else {
                return redirect('/mahasiswa/profil')->with([
                    'message' => 'Data Profil Gagal dirubah !',
                    'alert' => 'alert-danger',
                ]);
            }
        }
    }

    public function gantiPasswordPage()
    {
        return view('ganti_password');
    }
    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ], ["password.same" => "Password tidak cocok !", "password.min" => "Password minimal 6 karakter! "]);
        $user = User::where('id', Auth::user()->id)->update(array('password' => Hash::make($request->password)));
        if ($user) {
            if (Auth::user()->role == 1) {
                return redirect()->route("admin.gantiPassword")->with([
                    'message' => 'Password Berhasil dirubah !',
                    'alert' => 'alert-success',
                ]);
            } elseif (Auth::user()->role == 2) {
                return redirect()->route("dosen.gantiPassword")->with([
                    'message' => 'Password Berhasil dirubah !',
                    'alert' => 'alert-success',
                ]);
            } else {
                return redirect()->route("mahasiswa.gantiPassword")->with([
                    'message' => 'Password Berhasil dirubah !',
                    'alert' => 'alert-success',
                ]);
            }
        } else {
            return redirect('/mahasiswa/gantiPassword')->with([
                'message' => 'Password Gagal dirubah !',
                'alert' => 'alert-danger',
            ]);
        }
    }

    public function permissionDenied()
    {
        return view("errors/check-permission");
    }
}
