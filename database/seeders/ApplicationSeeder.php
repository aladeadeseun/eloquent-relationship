<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Deployment;
use App\Models\Environment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i < 5; $i++){
            Application::factory()->has(
                Environment::factory()
                    ->count(3)
                    ->has(
                        Deployment::factory()->count(10), 
                        'deployments'
                    ), 
                'environments'
            )
            ->create();
        }
    }
}
