<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User; // nếu model User nằm ở App\Models\User

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Nếu user đã tồn tại thì bỏ qua (tránh duplicate khi chạy nhiều lần)
        if (User::where('email', 'admin2gmail.com')->exists()) {
            $this->command->info('User admin2gmail.com already exists, skipping.');
            return;
        }

        User::create([
            'name' => 'Admin 2',
            'email' => 'admin2gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);

        $this->command->info('Seeded user: admin2gmail.com / 123456');
    }
}
