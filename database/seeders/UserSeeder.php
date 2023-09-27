<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
        User::insert([[
            'name' => 'Test Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ], [
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]]);

        $adminRole = Role::where('title', Role::ROLE_ADMIN)->first();
        $userRole = Role::where('title', Role::ROLE_USER)->first();

        $admin = User::where('email', 'admin@gmail.com')->first();
        $user = User::where('email', 'user@gmail.com')->first();

        DB::table('role_user')->insert([[
            'user_id' => $user->id,
            'role_id' => $userRole->id
        ], [
            'user_id' => $admin->id,
            'role_id' => $adminRole->id
        ]]);
    }
}
