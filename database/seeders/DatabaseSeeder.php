<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::factory()->create([
            'name' => 'Achyut Neupane',
            'email' => 'achyutkneupane@gmail.com',
            'username' => 'achyut',
            'password' => Hash::make('Ghost0vperditi0n')
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Restaurant::factory(10)->create();
    }
}
