<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles with the correct guard
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'superadmin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);
        $permissionOrderManagement = Permission::firstOrCreate(['name' => 'manage_orders', 'guard_name' => 'web']);
        // Assign the permission to roles other than admin
$customerRole->givePermissionTo($permissionOrderManagement);
// Repeat this for other roles as needed

        // Define permissions with the correct guard
        $permissions = [
            'create_categories',
            'edit_categories',
            'delete_categories',
            'list_categories',
            'create_brands',
            'edit_brands',
            'delete_brands',
            'list_brands',
            'create_products',
            'edit_products',
            'delete_products',
            'list_products',
            'create_coupons',
            'list_coupons',
            'delete_coupons',
            'edit_coupons',
            'create_inventories',
            'list_inventories',
            'edit_inventories',
            'delete_inventories',
            'create_shipments',
            'list_shipments',
            'edit_shipments',
            'delete_shipments'




        ];

        // Create and assign permissions to admin role with the correct guard
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'superadmin']);
            $adminRole->givePermissionTo($permission);
        }
    }
}