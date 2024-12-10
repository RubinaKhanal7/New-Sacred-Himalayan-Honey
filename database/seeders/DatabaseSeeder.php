<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First, run the RolesAndPermissionsSeeder to create roles and permissions
        $this->call(RolesAndPermissionsSeeder::class);

        // Then, run the SuperAdminSeeder to create the SuperAdmin user and assign the admin role
        $this->call(SuperAdminSeeder::class);

        $this->call(SitesettingSeeder::class);

        $this->call(AboutSeeder::class);

        $this->call(WhyUsSeeder::class);

        // Finally, create the Test User (if needed)
        // User::factory(10)->create();

        // Uncomment the line below to create the Test User
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
