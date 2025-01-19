<?php

namespace Database\Seeders;

use App\Models\Link;
use Database\Factories\LinkFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 20;
        for ($i = 1; $i <= 10000; $i++) {
            $links = [];
            for ($j = 1; $j <= $count; $j++) {
                $address = fake()->url() . "/$i/" . rand(0, 9999999);
                $links[] = [
                    'id' => fake()->uuid(),
                    'address' => $address,
                    'hash' => bcrypt($address),
                    'visits_count' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null,
                ];
            }
            Link::insertOrIgnore($links);
            echo "Seeding: $i * $count" . "\n";
        }
    }
}
