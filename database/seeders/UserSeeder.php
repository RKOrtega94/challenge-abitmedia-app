<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info("Seeding users...");

        if ($this->command->confirm("Do you want to seed users?")) {
            $this->command->info("Seeding users...");

            User::create([
                "name" => $this->command->ask("What is the user's name?", "Test User"),
                "email" => $this->command->ask("What is the user's email?", "test@email.com"),
                "password" => bcrypt($this->command->ask("What is the user's password?", "password")),
            ]);
        } else {
            $this->command->info("No users seeded.");
        }

        $this->command->info("Press enter to continue...");

        Artisan::call('passport:client', ['--personal' => true]);
    }
}
