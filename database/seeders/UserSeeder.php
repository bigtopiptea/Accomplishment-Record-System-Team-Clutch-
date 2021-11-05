<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'head of office']);
        $role3 = Role::create(['name' => 'staff']);

        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@da.gov.ph',
            'password' => Hash::make('admin123'),
            'position' => 'UNDERSECRETARIES'
        ]);
        $user->assignRole($role1);

        $user = User::factory()->create([
            'name' => 'Head of Office User',
            'email' => 'headofoffice@da.gov.ph',
            'password' => Hash::make('headofoffice123'),
            'position' => 'ASSISTANT SECRETARIES'
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@da.gov.ph',
            'password' => Hash::make('staff123'),
            'position' => 'DEPUTY CHIEF OF STAFF'
        ]);
        $user->assignRole($role3);
    }
}
