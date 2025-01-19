<?php

namespace Database\Seeders;

use Database\Factories\LinkFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $linkFactory = LinkFactory::new();
        $count = 1000;
        for ($i = 1; $i < 2; $i++) {
            $linkFactory->createMany($count);
            echo "Seeding: " . $i * $count;
        }
    }
}
