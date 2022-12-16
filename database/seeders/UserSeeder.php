<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'created_by' => 1,
            'role_id' => 1,
            'status' => 1,
            'email_status' => 1,
            'slug' => 'admin',
            'password' => Hash::make('admin@123')   
        ]);
    }
}
