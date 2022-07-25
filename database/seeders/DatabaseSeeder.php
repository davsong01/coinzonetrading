<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\User;
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
        Package::factory(3)->create();
        User::factory([
            'email' => 'dev@coinzonetrading.test',
            'password' => Hash::make('password'),
        ])->create();
    }
}
