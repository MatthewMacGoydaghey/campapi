<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'login' => "admin",
            'password' => "1234"
        ]);

        $admin = User::where("login", '=', "admin")->firstOrFail();

        DB::table('profiles')->insert([
            'name' => Str::random(15),
            'user' => $admin->id,
            'position' => "ADMIN"
        ]);
    }
    }

