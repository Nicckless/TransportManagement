<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Worker::factory()->create([
            'name' => 'Admin',
            'password'=>Hash::make('password'),
            'role'=>'admin'
        ]);

        Worker::factory()->create([
            'name' => 'Manager',
            'password'=>Hash::make('password'),
            'role'=>'manager'
        ]);

        Worker::factory()->create([
            'name' => 'Worker',
            'password'=>Hash::make('123'),
            'role'=>'worker'
        ]);

        Worker::factory()->create([
            'name' => 'Trucker',
            'password'=>Hash::make('123'),
            'role'=>'trucker'
        ]);
    }
}
