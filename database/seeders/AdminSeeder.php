<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin account
        User::create([
            'name' => 'Admin Calfa Salon',
            'email' => 'admin@calfasalon.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        echo "Admin account created successfully!\n";
        echo "Email: admin@calfasalon.com\n";
        echo "Password: admin123\n";
    }
}
