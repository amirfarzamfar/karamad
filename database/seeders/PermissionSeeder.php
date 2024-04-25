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
        // chat
        Permission::create(['name' => 'chat.store']);
        Permission::create(['name' => 'chat.see']);
        Permission::create(['name' => 'chat.all']);
        Permission::create(['name' => 'chat.destroy']);

        // message
        Permission::create(['name' => 'message.store']);
        Permission::create(['name' => 'message.destroy']);
        Permission::create(['name' => 'message.update']);
        Permission::create(['name' => 'message.mark_as_seen']);
    }
}
