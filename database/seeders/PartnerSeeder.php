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
        Partner::create([
            'image_path' => 'partners/sample.png',
            'alt_text' => 'Sample Partner',
            'sort_order' => 1,
        ]);
    }
}
