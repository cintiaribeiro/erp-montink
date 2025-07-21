<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'DESCONTO10',
                'discount' => 10.00,
                'expiration_date' => now()->addDays(10),
                'minimum_value' => 50.00,
            ],
            [
                'code' => 'FRETEGRATIS',
                'discount' => 15.00,
                'expiration_date' => now()->addDays(20),
                'minimum_value' => 100.00,
            ],
            [
                'code' => 'BLACKFRIDAY',
                'discount' => 30.00,
                'expiration_date' => now()->addDays(5),
                'minimum_value' => 200.00,
            ],
        ];

        foreach ($coupons as $data) {
            Coupon::create([
                'uuid' => Str::uuid(),
                'code' => $data['code'],
                'discount' => $data['discount'],
                'expiration_date' => $data['expiration_date'],
                'minimum_value' => $data['minimum_value'],
            ]);
        }
    }
}
