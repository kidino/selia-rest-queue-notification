<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run the RoleSeeder
        $this->call(RoleSeeder::class);

        // Create the admin user
        $adminUserId = DB::table('users')->insertGetId([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Get the Admin role ID
        $adminRoleId = DB::table('roles')->where('name', 'Admin')->value('id');

        // Assign the Admin role to the admin user
        DB::table('role_user')->insert([
            'user_id' => $adminUserId,
            'role_id' => $adminRoleId,
        ]);
    }
}
