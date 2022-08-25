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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Epsilon Dimitar User',
            'email' => 'hello@dimitarpapazov.com',
            'password' => Hash::make('123123'),
            'epsilon_client_id' => config('epsilon.api_credentials.client_id'),
            'epsilon_client_secret' => config('epsilon.api_credentials.client_secret'),
            'epsilon_access_token' => null,
            'epsilon_access_token_expires_in' => null,
            'epsilon_refresh_token' => null,
        ]);
    }
}
