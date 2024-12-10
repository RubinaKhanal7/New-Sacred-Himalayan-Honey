<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\SuperAdmin;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create SuperAdmin user
        $superadmin = SuperAdmin::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Superadmin Name',
                'password' => Hash::make('password1')
            ]
        );

        // Assign admin role to SuperAdmin
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole && $superadmin) {
            $superadmin->assignRole($adminRole);
        }
    }
}
