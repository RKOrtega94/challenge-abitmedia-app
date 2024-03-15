<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->command->confirm("Do you want to seed services?")) {

            $this->command->info("Seeding services...");

            Service::create([
                "sku" => substr(md5(rand()), 0, 10),
                "name" => "Formateo de computadores",
                "description" => "Formateo de computadores",
                "price" => 25
            ]);

            Service::create([
                "sku" => substr(md5(rand()), 0, 10),
                "name" => "Mantenimiento",
                "description" => "Mantenimiento de computadores",
                "price" => 30
            ]);

            Service::create([
                "sku" => substr(md5(rand()), 0, 10),
                "name" => "Hora de soporte en software",
                "description" => "Hora de soporte en software",
                "price" => 50
            ]);
        }
    }
}
