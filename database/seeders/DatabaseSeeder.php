<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Position;
use App\Models\Shift;
use App\Models\ShiftSwap;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Branches (managers assigned after users are created)
        $bayanan = Branch::create([
            'name'    => 'Bayanan',
            'address' => 'Bayanan, Muntinlupa',
        ]);

        $putatan = Branch::create([
            'name'    => 'Putatan',
            'address' => '65 National Road, Putatan, Muntinlupa',
        ]);

        $poblacion = Branch::create([
            'name'    => 'Poblacion',
            'address' => 'Poblacion address',
        ]);

        $sanPedro = Branch::create([
            'name'    => 'San Pedro',
            'address' => 'San Pedro address',
        ]);

        // Positions
        $adminPos = Position::create([
            'name'        => 'Admin',
            'slug'        => 'admin',
            'description' => 'System administrator',
            'is_active'   => true,
        ]);

        $managerPos = Position::create([
            'name'        => 'Manager',
            'slug'        => 'manager',
            'description' => 'Branch manager',
            'is_active'   => true,
        ]);

        $cashier = Position::create([
            'name' => 'Cashier',
            'slug' => 'cashier',
            'description' => 'Front counter cashier',
            'is_active' => true,
        ]);

        $bagger = Position::create([
            'name' => 'Bagger',
            'slug' => 'bagger',
            'description' => 'Bagging and front support',
            'is_active' => true,
        ]);

        $stock = Position::create([
            'name' => 'Stock Clerk',
            'slug' => 'stock-clerk',
            'description' => 'Warehouse and shelf restock',
            'is_active' => true,
        ]);

        // Users
        $admin = User::create([
            'name'            => 'System Admin',
            'email'           => 'admin@example.com',
            'password'        => bcrypt('password'),
            'role'            => 'admin',
            'position_id'     => $adminPos->id,
            'employment_type' => 'full-time',
            'hired_at'        => '2023-01-01',
        ]);
        $admin->branches()->attach([$bayanan->id, $putatan->id, $poblacion->id, $sanPedro->id]);

        $manager = User::create([
            'name'            => 'Maria Lourdes Ramos',
            'email'           => 'maria.ramos@example.com',
            'phone'           => '09171234567',
            'password'        => bcrypt('password'),
            'role'            => 'manager',
            'position_id'     => $managerPos->id,
            'employment_type' => 'full-time',
            'hired_at'        => '2023-03-15',
        ]);
        $manager->branches()->attach($putatan->id);
        $putatan->update(['manager_id' => $manager->id]);

        $alice = User::create([
            'name'            => 'Alice Santos',
            'email'           => 'alice@example.com',
            'phone'           => '09189876543',
            'password'        => bcrypt('password'),
            'role'            => 'employee',
            'position_id'     => $cashier->id,
            'employment_type' => 'full-time',
            'hired_at'        => '2024-06-01',
        ]);
        $alice->branches()->attach($putatan->id);

        $bob = User::create([
            'name'            => 'Bob Dela Cruz',
            'email'           => 'bob@example.com',
            'phone'           => '09201112233',
            'password'        => bcrypt('password'),
            'role'            => 'employee',
            'position_id'     => $cashier->id,
            'employment_type' => 'part-time',
            'hired_at'        => '2024-09-10',
        ]);
        $bob->branches()->attach($putatan->id);

        $charlie = User::create([
            'name'            => 'Charlie Reyes',
            'email'           => 'charlie@example.com',
            'password'        => bcrypt('password'),
            'role'            => 'employee',
            'position_id'     => $bagger->id,
            'employment_type' => 'casual',
            'hired_at'        => '2025-01-20',
        ]);
        $charlie->branches()->attach($putatan->id);

        // Shifts (dated assignments)
        $shift1 = Shift::create([
            'branch_id' => $putatan->id,
            'position_id' => $cashier->id,
            'user_id' => $alice->id,
            'shift_date' => date('Y-m-d'),
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
            'status' => 'assigned',
            'notes' => 'Morning shift',
        ]);

        $shift2 = Shift::create([
            'branch_id' => $putatan->id,
            'position_id' => $cashier->id,
            'user_id' => $bob->id,
            'shift_date' => date('Y-m-d', strtotime('+1 day')),
            'start_time' => '16:00:00',
            'end_time' => '22:00:00',
            'status' => 'assigned',
            'notes' => 'Evening shift',
        ]);

        // Seed a sample shift swap (Alice requests Bob to take her shift)
        ShiftSwap::create([
            'shift_id' => $shift1->id,
            'requested_by' => $alice->id,
            'requested_to' => $bob->id,
            'status' => 'pending_recipient',
            'request_message' => 'Can you cover my morning shift tomorrow?',
        ]);

        // Optionally, more demo data can be added here for other branches and roles
    }
}
