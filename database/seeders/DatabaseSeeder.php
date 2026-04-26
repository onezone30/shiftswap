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
        // Branches
        $bayanan = Branch::create([
            'name' => 'Bayanan',
            'address' => 'Bayanan, Muntinlupa',
            'manager_name' => 'Manager Bayanan',
        ]);

        $putatan = Branch::create([
            'name' => 'Putatan',
            'address' => '65 National Road, Putatan, Muntinlupa',
            'manager_name' => 'Maria Lourdes Ramos',
        ]);

        $poblacion = Branch::create([
            'name' => 'Poblacion',
            'address' => 'Poblacion address',
        ]);

        $sanPedro = Branch::create([
            'name' => 'San Pedro',
            'address' => 'San Pedro address',
        ]);

        // Positions
        $managerPos = Position::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'description' => 'Branch manager',
            'is_active' => true,
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
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'branch_id' => $bayanan->id,
            'position_id' => $managerPos->id,
        ]);

        $manager = User::create([
            'name' => 'Maria Lourdes Ramos',
            'email' => 'maria.ramos@example.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
            'branch_id' => $putatan->id,
            'position_id' => $managerPos->id,
        ]);

        $alice = User::create([
            'name' => 'Alice Santos',
            'email' => 'alice@example.com',
            'password' => bcrypt('password'),
            'role' => 'employee',
            'branch_id' => $putatan->id,
            'position_id' => $cashier->id,
        ]);

        $bob = User::create([
            'name' => 'Bob Dela Cruz',
            'email' => 'bob@example.com',
            'password' => bcrypt('password'),
            'role' => 'employee',
            'branch_id' => $putatan->id,
            'position_id' => $cashier->id,
        ]);

        $charlie = User::create([
            'name' => 'Charlie Reyes',
            'email' => 'charlie@example.com',
            'password' => bcrypt('password'),
            'role' => 'employee',
            'branch_id' => $putatan->id,
            'position_id' => $bagger->id,
        ]);

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
