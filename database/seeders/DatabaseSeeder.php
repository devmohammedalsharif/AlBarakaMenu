<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $email = 'ahmed@admin.com';
        $password = 'ahmedAdmin';

        $user = User::query()->where('email', $email)->first();
        if ($user !== null) {
            $user->update([
                'name' => 'Admin',
                'password' => $password,
                'is_admin' => true,
            ]);

            return;
        }

        foreach (['admin@ahmed.com', 'admin@albraka.test'] as $legacyEmail) {
            $legacy = User::query()->where('email', $legacyEmail)->first();
            if ($legacy !== null) {
                $legacy->update([
                    'email' => $email,
                    'name' => 'Admin',
                    'password' => $password,
                    'is_admin' => true,
                ]);

                return;
            }
        }

        User::query()->create([
            'name' => 'Admin',
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
        ]);
    }
}
