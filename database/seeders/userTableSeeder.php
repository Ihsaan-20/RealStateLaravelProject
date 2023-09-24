<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('users')->insert([
        // Admin
        [
            'name' => 'Admin',
            'username' => 'admin20',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123),
            'role' => 'admin',
            'status' => 'active'
        ],

        // agent
        [
            'name' => 'Agent',
            'username' => 'agent20',
            'email' => 'agent@gmail.com',
            'password' => Hash::make(123),
            'role' => 'agent',
            'status' => 'active'
        ],
         // user
         [
            'name' => 'Ihsan Gohar',
            'username' => 'ihsaan20',
            'email' => 'ihsaan@gmail.com',
            'password' => Hash::make(123),
            'role' => 'agent',
            'status' => 'active'
        ]


    ]);
    }
}
