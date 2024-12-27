<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $pembeliRole = Role::where('name', 'pembeli')->first();
        $penjualRole = Role::where('name', 'penjual')->first();
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ])->assignRole($adminRole);

        User::create([
            'name' => 'Pembeli',
            'email' => 'pembeli@example.com',
            'password' => Hash::make('12345678'),
        ])->assignRole($pembeliRole);

        User::create([
            'name' => 'Penjual',
            'email' => 'penjual@example.com',
            'password' => Hash::make('12345678'),
        ])->assignRole($penjualRole);
    }
}
