<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username'=>'nabila',
            'email'=>'nabila@gmail.com',
            'password'=>Hash::make('nabila'),
            'phone'=>'083854647297',
            'address'=>'Pekanbaru',
            'role_id'=>'2',
        ]);
    }
}
