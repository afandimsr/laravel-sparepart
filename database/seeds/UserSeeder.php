<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::create([
            'name' => "Mohamad Afandi",
            'cd_user' => "5302417001",
            'no_hp' => "082226832896",
            'email' => "mohamadafandi71@gmail.com",
            'username' => "afandi007",
            'foto_profil' => 'default.png',
            'password' => Hash::make("afandi007"),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),

        ]);
        $user->assignRole('admin');
    }
}
