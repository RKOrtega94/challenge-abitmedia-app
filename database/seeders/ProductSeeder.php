<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->command->confirm("Do you want to seed products?")) {
            $this->command->info("Seeding products...");

            Product::create([
                "sku" => substr(md5(rand()), 0, 10),
                "name" => "Antivirus",
                "description" => "Antivirus software",
                "windows_price" => 5,
                "mac_price" => 7
            ])->stock()->create([
                "windows_stock" => 10,
                "mac_stock" => 10
            ]);

            Product::create([
                "sku" => substr(md5(rand()), 0, 10),
                "name" => "Ofimática",
                "description" => "Software de ofimática",
                "windows_price" => 10,
                "mac_price" => 12
            ])->stock()->create([
                "windows_stock" => 20,
                "mac_stock" => 20
            ]);

            Product::create([
                "sku" => substr(md5(rand()), 0, 10),
                "name" => "Editor de video",
                "description" => "Software de edición de video",
                "windows_price" => 20,
                "mac_price" => 22
            ])->stock()->create([
                "windows_stock" => 30,
                "mac_stock" => 30
            ]);
        }
    }
}
