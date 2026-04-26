<?php

namespace Database\Seeders;

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
        $admin = \App\Models\User::create([
            'name' => 'Admin Anjay',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
        ]);

        $customer = \App\Models\User::create([
            'name' => 'Alex Customer',
            'email' => 'alex@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        \App\Models\Complaint::create([
            'complaint_code' => '#CMP-9280',
            'user_id' => $customer->id,
            'order_number' => 'ORD-2026-X102',
            'product_name' => 'Keyboard Mechanical X1',
            'damage_category' => 'Pecah/Retak',
            'description' => 'Layar monitor bergaris hijau setelah dinyalakan 5 menit.',
            'refund_method' => 'Bank Transfer (BCA)',
            'status' => 'pending',
            'created_at' => '2026-04-05 10:00:00',
        ]);

        \App\Models\Complaint::create([
            'complaint_code' => '#CMP-9255',
            'user_id' => $customer->id,
            'order_number' => 'ORD-2026-B992',
            'product_name' => 'Mouse Wireless Pro',
            'damage_category' => 'Salah Warna',
            'description' => 'Barang tidak sesuai (Salah warna: pesan Hitam, datang Putih).',
            'refund_method' => 'E-Wallet (Gopay)',
            'status' => 'done',
            'completed_at' => '2026-04-02 15:30:00',
            'created_at' => '2026-04-01 09:00:00',
        ]);
    }
}
