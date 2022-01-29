<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      User::create([
            'name' => 'admin',
            'password' => Hash::make('pass112233'),
            'email' => 'admin@example.com',
            'is_admin' => true
        ]);
    }
}
