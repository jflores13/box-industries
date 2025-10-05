<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'BoxCraft',
                'short_description' => 'Our solution for tailored corrugated packaging',
                'long_description' => 'We design and manufacture corrugated boxes and containers in a variety of sizes and formats, adapted to your product\'s usage, storage, and handling needs. Glued or stapled, and available in multiple grades and flute types — ideal for nearly any packaging application.',
                'slug' => 'boxcraft',
                'button_text' => 'Get a Custom Quote',
                'button_link' => '/',
                'image_src' => '/img/products/Product-BoxCraft.webp',
                'booklet_src' => null,
                'product_id' => '1',
                'category' => 'boxes',
                'tags' => null,
                'on_carrousel' => true,
            ],
            [
                'name' => 'CorroPack',
                'short_description' => 'Our solution for returnable plastic packaging',
                'long_description' => 'We produce a wide range of coroplast (plastic corrugated) packaging — from standard boxes to fully customized solutions in various thicknesses. Durable, washable, and ideal for repeated use.',
                'slug' => 'corropack',
                'button_text' => 'Get a Custom Quote',
                'button_link' => '/products',
                'image_src' => '/img/products/Product-CorroPack.webp',
                'booklet_src' => null,
                'product_id' => '2',
                'category' => 'boxes',
                'tags' => null,
                'on_carrousel' => true,
            ],
            [
                'name' => 'CorroDividers',
                'short_description' => 'Our solution for organized, modular protection',
                'long_description' => 'Coroplast dividers are designed for standalone use or integration with CorroPack® boxes and containers. Each divider is custom-engineered after product analysis to ensure optimal fit, durability, and functionality.',
                'slug' => 'corrodividers',
                'button_text' => 'Get a Custom Quote',
                'button_link' => '/',
                'image_src' => '/img/products/Product-CorroDividers.webp',
                'booklet_src' => null,
                'product_id' => '3',
                'category' => 'boxes',
                'tags' => null,
                'on_carrousel' => false,
            ],
            [
                'name' => 'CoreTube',
                'short_description' => 'Our solution for rolled goods and secure transport',
                'long_description' => 'We offer cardboard tubes in various diameters and lengths, ideal for winding thread, fabric, cable, tape, paper, and more — or for shipping documents, posters, and rods. Custom-cut to your product needs.',
                'slug' => 'coretube',
                'button_text' => 'Get a Custom Quote',
                'button_link' => '/',
                'image_src' => '/img/products/Product-CoreTube.webp',
                'booklet_src' => null,
                'product_id' => '4',
                'category' => 'extras',
                'tags' => null,
                'on_carrousel' => false,
            ],
            [
                'name' => 'EdgeGuard',
                'short_description' => 'Our solution for corner protection',
                'long_description' => 'An efficient way to reinforce packaging while minimizing cost. Our cardboard edge protectors offer strong structural support during transport and storage.',
                'slug' => 'edgeguard',
                'button_text' => 'Get a Custom Quote',
                'button_link' => '/',
                'image_src' => '/img/products/Product-EdgeGuard.webp',
                'booklet_src' => null,
                'product_id' => '5',
                'category' => 'protection',
                'tags' => null,
                'on_carrousel' => false,
            ],
            [
                'name' => 'GridCell',
                'short_description' => 'Our solution for internal product protection',
                'long_description' => 'Custom corrugated dividers designed to protect delicate or stacked items like glassware, ceramics, electronics, and plastic parts. Supplied as standalone or integrated solutions.',
                'slug' => 'gridcell',
                'button_text' => 'Get a Custom Quote',
                'button_link' => '/',
                'image_src' => '/img/products/Product-GridCell.webp',
                'booklet_src' => null,
                'product_id' => '6',
                'category' => 'protection',
                'tags' => null,
                'on_carrousel' => true,
            ],
            [
                'name' => 'LoadBoard',
                'short_description' => 'Our solution for lightweight, durable pallets',
                'long_description' => 'Corrugated cardboard pallets that are strong, lightweight, and easy to handle. Suitable for a wide range of industries and customizable to your specific dimensions and usage needs.',
                'slug' => 'loadboard',
                'button_text' => 'Get a Custom Quote',
                'button_link' => '/',
                'image_src' => '/img/products/Product-LoadBoard.webp',
                'booklet_src' => null,
                'product_id' => '7',
                'category' => 'extras',
                'tags' => null,
                'on_carrousel' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
