<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'title' => 'Pending'
        ]);
        Status::create([
            'title' => 'In Progress'
        ]);
        Status::create([
            'title' => 'Blocked'
        ]);
        Status::create([
            'title' => 'Finished'
        ]);
    }
}
