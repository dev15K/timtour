<?php

namespace Database\Seeders;

use App\Enums\TypeUser;
use App\Enums\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'full_name' => 'demo',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'),
                'username' => 'user',
                'phone' => '0989889889',
                'address' => 'HAIPHONG',
                'about' => '',
                'status' => UserStatus::ACTIVE,
            ],
            [
                'full_name' => 'demo',
                'email' => 'moderator@gmail.com',
                'password' => Hash::make('123456'),
                'username' => 'moderator',
                'phone' => '0989889889',
                'address' => 'HANOI',
                'about' => '',
                'status' => UserStatus::ACTIVE,
            ],
            [
                'full_name' => 'demo',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'username' => 'admin',
                'phone' => '0989889889',
                'address' => 'HANOI',
                'about' => '',
                'status' => UserStatus::ACTIVE,
            ]

        ];
        DB::table('users')->insert($users);
    }
}
