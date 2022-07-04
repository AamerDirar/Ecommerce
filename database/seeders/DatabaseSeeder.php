<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'name' => 'Super Admin',
        ]);

        User::factory()->create([
            'email' => 'editor@editor.com',
            'password' => '12345678',
            'name' => 'Editor',
        ]);

        $this->call(RolesSeeder::class);
    }
}
