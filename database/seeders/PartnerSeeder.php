<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'image_path' => 'partners/qhbr0T7QokAlUnWi8GmagtvXLLst3oKUQwVX630i.png',
                'alt_text' => 'HayGroup',
                'sort_order' => 1,
            ],
            [
                'image_path' => 'partners/qdPEDYe1i9XyCGXMuTLiRdoHgigS2lZCA6aS2dlu.png',
                'alt_text' => 'Adidas',
                'sort_order' => 2,
            ],
            [
                'image_path' => 'partners/aY4jHM8maV15Cb4X64f8ReZa3wdwH9jPQFkyAiRG.png',
                'alt_text' => 'Volkswagen',
                'sort_order' => 4,
            ],
            [
                'image_path' => 'partners/gvnEqhlaK5ej12E4RdsWh5jC1eqgly3LU2TUhdds.png',
                'alt_text' => 'Sony',
                'sort_order' => 5,
            ],
            [
                'image_path' => 'partners/HZl3zhiUdbbBc5EKu0oi6H7tYbMVl4rzZ9Ye3bSJ.png',
                'alt_text' => 'Tesla',
                'sort_order' => 6,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
