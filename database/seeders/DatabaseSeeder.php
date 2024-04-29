<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
           PaymentPackagesSeeder::class,
           PermissionSeeder::class,
           RoleSeeder::class,
           CategorySeeder::class,
           UserSeeder::class,
           OrganizationSeeder::class,
           Adseeder::class,
           ResumeSeeder::class,
           ReapetedQuestionSeeder::class,
           AboutSeeder::class,
           BenefiteSeeder::class
       ]);
    }
}
