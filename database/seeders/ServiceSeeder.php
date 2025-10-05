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
        $services = [
            [
                'name' => 'Engineering Design',
                'short_description' => 'The foundation of packaging innovation',
                'long_description' => 'We rely on advanced CAD tools to develop packaging solutions that meet functional, structural, and logistical needs. From the first sketch to the final model, our design process ensures efficiency, precision, and adaptability. CAD design allows us to collaborate across disciplines, detect potential issues early, and simulate packaging performance before moving into production.',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
