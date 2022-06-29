<?php

namespace Database\Seeders;

use DateTime;
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
        // Add Users
        DB::table('users')->insert([
            'name' => 'M. Rifky Naratama Susanto',
            'username' => 'muhrifkyns',
            'password' => Hash::make('admin123')
        ]);
    }
}
