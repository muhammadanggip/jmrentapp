<?php

namespace Database\Seeders;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'address' => 'Bandung',
            'phone' => '123',
            'license_number' => '123',
            'created_at' => now(),
            'updated_at' => now()
        ],
        );

        DB::table('cars')->insert([
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'license_plate' => 'D 1234 ABC',
                'rental_rate_per_day' => 500000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Honda',
                'model' => 'Civic',
                'license_plate' => 'D 5678 DEF',
                'rental_rate_per_day' => 450000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Ford',
                'model' => 'Mustang',
                'license_plate' => 'D 9012 GHI',
                'rental_rate_per_day' => 800000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'BMW',
                'model' => '3 Series',
                'license_plate' => 'D 3456 JKL',
                'rental_rate_per_day' => 600000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Mercedes',
                'model' => 'C Class',
                'license_plate' => 'D 7890 MNO',
                'rental_rate_per_day' => 700000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4',
                'license_plate' => 'D 1122 PQR',
                'rental_rate_per_day' => 650000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Nissan',
                'model' => 'Altima',
                'license_plate' => 'D 3344 STU',
                'rental_rate_per_day' => 400000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Kia',
                'model' => 'Optima',
                'license_plate' => 'D 5566 VWX',
                'rental_rate_per_day' => 380000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Elantra',
                'license_plate' => 'D 7788 YZA',
                'rental_rate_per_day' => 370000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Mazda',
                'model' => '6',
                'license_plate' => 'D 9900 BCD',
                'rental_rate_per_day' => 460000,
                'available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
