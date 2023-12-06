<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([  
           'name' => 'Admin',     
           'email' => 'admin@gmail.com',     
           'password' => Hash::make('12345678'),     
           'role' => 0,     
           'phone' => '12345678',     
           'pass_status' => 1,     
           'created_at' => Carbon::now()->toDateTimeString(),     
           'updated_at' => Carbon::now()->toDateTimeString(),     
        ]);

      
    }
}
