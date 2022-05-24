<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
        DB::table('users')->insert([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => bcrypt("admin12"),
            "role" => User::ADMIN,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}
