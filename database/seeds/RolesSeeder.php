<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Role::create([
            "name" => "admin",
            "guard_name" => "web",
        ]);
        // Role::create([
        //     "name" => "dosen",
        //     "guard_name" => "web",
        // ]);

        // Role::create([
        //     "name" => "mahasiswa",
        //     "guard_name" => "web",
        // ]);
    }
}
