<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@tasksapp.net',
            'password' => Hash::make('super_admin')
        ]);

        $super_admin->assignRole('super admin');

        $employee = User::create([
            'name' => 'employee',
            'email' => 'employee@tasksapp.net',
            'password' => Hash::make('employee')
        ]);

        $employee->assignRole('employee');
    }
}
