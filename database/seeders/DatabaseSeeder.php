<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Position;
use App\Models\Nomination;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create CEO/Admin
        User::create([
            'name' => 'System Admin (CEO)',
            'staff_id' => 'CEO001',
            'workplace' => 'HQ',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Sample Members
        $m1 = User::create([
            'name' => 'Ahmad Faiz',
            'staff_id' => 'STF101',
            'workplace' => 'Terminal A',
            'password' => Hash::make('password'),
        ]);

        $m2 = User::create([
            'name' => 'Siti Aminah',
            'staff_id' => 'STF102',
            'workplace' => 'Terminal B',
            'password' => Hash::make('password'),
        ]);

        $m3 = User::create([
            'name' => 'John Doe',
            'staff_id' => 'STF103',
            'workplace' => 'Logistics',
            'password' => Hash::make('password'),
        ]);

        // Create Positions
        $p1 = Position::create(['title' => 'President']);
        $p2 = Position::create(['title' => 'Secretary']);

        // Create Nominations
        Nomination::create([
            'nominee_id' => $m1->id,
            'nominator_id' => $m2->id,
            'position_id' => $p1->id,
        ]);

        Nomination::create([
            'nominee_id' => $m3->id,
            'nominator_id' => $m1->id,
            'position_id' => $p1->id,
        ]);

        Nomination::create([
            'nominee_id' => $m2->id,
            'nominator_id' => $m3->id,
            'position_id' => $p2->id,
        ]);
    }
}
