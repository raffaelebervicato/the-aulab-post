<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@aulabpost.test'],
            [
                'name'      => 'Admin',
                'password'  => Hash::make('password'),
                'is_admin'  => true,
                'is_revisor'=> true,
                'is_writer' => true,
            ]
        );
    }
}
