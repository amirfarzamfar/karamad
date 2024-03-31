<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // user
        Permission::create(['name' => 'user.see']);
        Permission::create(['name' => 'user.list']);
        Permission::create(['name' => 'user.store']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.update']);
        Permission::create(['name' => 'avatar.store']);
        Permission::create(['name' => 'avatar.destroy']);
        Permission::create(['name' => 'user.comment.store']);
        Permission::create(['name' => 'user.comment.see']);
        Permission::create(['name' => 'user.comment.destroy']);
        Permission::create(['name' => 'user.comment.update']);

        // filter
        Permission::create(['name' => 'able_to_filter']);
    }
}
