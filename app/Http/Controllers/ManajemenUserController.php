<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;

class ManajemenUserController extends Controller
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
        $users = User::all();
        $usersCount = $users->count();
        return view("admin/manajemen_user/index", compact('users', 'usersCount'));
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
            'nama' => 'required',
            'cd_user' => 'required|unique:users',
            'no_hp' => 'required|unique:users',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required',

        ], [
            "email.required" => "Email tidak boleh kosong",
            "cd_user.required" => "NIP//NIM tidak boleh kosong",
            "no_hp.required" => "No Hp tidak boleh kosong",
            "username.required" => "Username tidak boleh kosong",
            "password.required" => "Password tidak boleh kosong",
            "email.unique" => "Email sudah digunakan",

        ]);
        $users = User::create([
            "name" => $request->nama,
            "cd_user" => $request->cd_user,
            "no_hp" => $request->no_hp,
            "email" => $request->email,
            "username" => $request->username,
            "foto_profil" => "default.png",
            "role" => $request->role,
            "password" => Hash::make($request->password),
        ]);
        if ($users) {
            return redirect()->route('admin.manajemen_user.index')->with([
                "message" => "User Berhasil Ditambahkan",
                "alert" => "alert-success"
            ]);
        } else {
            return redirect()->route('admin.manajemen_user.index')->with([
                "message" => "User Gagal Ditambahkan",
                "alert" => "alert-danger"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view("admin/manajemen_user/edit", compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::FindOrFail($id);
        if ($user != null) {
            if ($request->file("profile")) {
                $request->validate([

                    'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:800',

                ], ["profile.max" => "* Ukuran gambar kurang dari 800 kb"]);
                $path = "img/profil/";
                $file = $request->file('profile');
                $newFileName = $user->cd_user . "." . $file->getClientOriginalExtension();
                $upload = $file->move($path, $newFileName);
                if ($upload) {
                    $user = User::where('id', $id)->update(array('foto_profil' => $newFileName));
                    if ($user) {
                        return redirect()->route("admin.manajemen_user.index")->with([
                            'message' => 'Gambar Profil ' . $request->name . ' Berhasil dirubah !',
                            'alert' => 'alert-success',
                        ]);
                    } else {
                        return redirect()->route("admin.manajemen_user.index")->with([
                            'message' => 'Gambar Profil ' . $request->name . ' Gagal dirubah !',
                            'alert' => 'alert-danger',
                        ]);
                    }
                }
            } else if ($request->input("password")) {
                $request->validate([
                    'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'min:6'
                ], ["password.same" => "Password tidak cocok !", "password.min" => "Password minimal 6 karakter! "]);
                $user = User::where('id', $id)->update(array('password' => Hash::make($request->password)));
                if ($user) {
                    return redirect()->route("admin.manajemen_user.index")->with([
                        'message' => 'Password ' . $request->name . ' Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                } else {
                    return redirect()->route("admin.manajemen_user.index")->with([
                        'message' => 'Password ' . $request->name . ' Gagal dirubah !',
                        'alert' => 'alert-danger',
                    ]);
                }
            } else {
                $request->validate([
                    "nama" => "required",
                    "cd_user" => "required",
                    "email" => "required|email",
                    "no_hp" => "required",
                    "role" => "required",
                ], ["cd_user.required" => "NIM/NIP tidak boleh kosong !", "email.required" => "Email tidak boleh kosong", "no_hp.required" => "No Hp tidak boleh kosong !"]);
                if ($request->role == 1) {
                    $user->syncRoles("pengelola");
                } elseif ($request->role == 2) {
                    $user->syncRoles("dosen");
                } elseif ($request->role == 3) {
                    $user->syncRoles("mahasiswa");
                } else {
                    $user->assignRole("");
                }
                $user = User::where('id', $id)->update([
                    "name" => $request->nama,
                    "cd_user" => $request->cd_user,
                    "email" => $request->email,
                    "no_hp" => $request->no_hp,
                    "updated_at" => date("Y-m-d H:i:s"),
                ]);

                if ($user) {
                    return redirect()->route("admin.manajemen_user.index")->with([
                        'message' => 'Data Profil ' . $request->name . ' Berhasil dirubah !',
                        'alert' => 'alert-success',
                    ]);
                } else {
                    return redirect()->route("admin.manajemen_user.index")->with([
                        'message' => 'Data Profil ' . $request->name . ' Gagal dirubah !',
                        'alert' => 'alert-danger',
                    ]);
                }
            }
        } else {
            return view("errors/check-permission");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        if ($users) {
            return redirect()->route("admin.manajemen_user.index")->with([
                "message" => "Data Berhasil Dihapus",
                "alert" => "alert-success",
            ]);
        } else {
            return redirect()->route("admin.manajemen_user.index")->with([
                "message" => "Data Gagal Dihapus Dihapus",
                "alert" => "alert-danger",
            ]);
        }
    }

    // public function gantiPassword(Request $request)
    // {
    //     $user = User::updateOrCreate(
    //         ['id' => $request->id],
    //         ['password' => Hash::make($request->password)]
    //     );
    //     if ($user) {
    //         // return redirect()->route("admin.manajemen_user.index")->with([
    //         //         "message"=>"Password Berhasil dirubah",
    //         //         "alert" =>"alert-success",
    //         //     ]);
    //         // return response()->json(['message'=>'Product saved successfully.']);
    //     }
    // }
}
