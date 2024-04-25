<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Role::create(['name' => 'user']);
        $admin = Role::create(['name' => 'admin']);
        $superAdmin = Role::create(['name' => 'superAdmin']);

        $superAdmin->givePermissionTo(Permission::all());
        $admin->givePermissionTo(Permission::all());

        $user->givePermissionTo(['chat.store', 'chat.see','message.store']);
    }
}
