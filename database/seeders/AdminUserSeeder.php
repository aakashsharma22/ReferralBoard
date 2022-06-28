<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        do {
            $token = Str::random(16);
        } while (User::where('unique_referral_code', $token)->first());

        return User::create([
            'name' => 'Admin',
            'email' => 'indiantiger1234@gmail.com',
            'password' => Hash::make('12345678'),
            'unique_referral_code' => $token,
            'is_admin' => 1
        ]);
    }
}
