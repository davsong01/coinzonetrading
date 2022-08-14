<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use Database\Factories\PackageFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::factory([
            'email' => 'dev@coinzonetrading.test',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ])->create();
        Package::factory(3)->create();
        Setting::factory()->create();
        Package::factory(5)->create();
        Wallet::factory(5)->create();

        $user->admin()->create();

        Wallet::factory(10, [
            'user_id' => $user->id,
        ])->create();
    }
}
