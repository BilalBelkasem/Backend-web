<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Maak een admin gebruiker aan
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ff14-website.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'username' => 'admin',
        ]);

        $this->command->info('Admin gebruiker aangemaakt: admin@ff14-website.com / admin123');
    }
}
