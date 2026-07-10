<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $p1 = Product::create([
            'name' => 'Scrunchie Glossy',
            'description' => 'Scrunchie bahan glossy, lembut dan elastis',
            'image' => '01.jpg',
            'seller_id' => 1,
            'category' => 'Scrunchie'
        ]);
        foreach (['Pink', 'Cream', 'Hitam'] as $var) {
            ProductVariant::create(['product_id' => $p1->id, 'variant_name' => $var, 'price' => 4000, 'stock' => 10]);
        }

        $p2 = Product::create([
            'name' => 'Scrunchie Bulu',
            'description' => 'Scrunchie berbulu lembut, lucu dan stylish',
            'image' => '02.jpg',
            'seller_id' => 1,
            'category' => 'Scrunchie'
        ]);
        foreach (['Pink', 'Biru', 'Peach'] as $var) {
            ProductVariant::create(['product_id' => $p2->id, 'variant_name' => $var, 'price' => 3000, 'stock' => 10]);
        }

        $p3 = Product::create([
            'name' => 'Jepit Polos 4 pcs',
            'description' => 'Jepit rambut polos isi 4 pcs, warna cantik',
            'image' => '03.jpg',
            'seller_id' => 1,
            'category' => 'Jepit'
        ]);
        foreach (['Pink', 'Putih', 'Biru'] as $var) {
            ProductVariant::create(['product_id' => $p3->id, 'variant_name' => $var, 'price' => 4000, 'stock' => 10]);
        }

        $p4 = Product::create([
            'name' => 'Jedai Bunga Glitter',
            'description' => 'Jedai bentuk bunga dengan glitter cantik',
            'image' => '04.jpg',
            'seller_id' => 1,
            'category' => 'Jedai'
        ]);
        foreach (['Pink', 'Biru', 'Brown'] as $var) {
            ProductVariant::create(['product_id' => $p4->id, 'variant_name' => $var, 'price' => 8000, 'stock' => 10]);
        }

        $p5 = Product::create([
            'name' => 'Jedai Bunga Polos',
            'description' => 'Jedai bentuk bunga simple dan elegan',
            'image' => '05.jpg',
            'seller_id' => 1,
            'category' => 'Jedai'
        ]);
        foreach (['Putih', 'Pink', 'Biru'] as $var) {
            ProductVariant::create(['product_id' => $p5->id, 'variant_name' => $var, 'price' => 8000, 'stock' => 10]);
        }

        $p6 = Product::create([
            'name' => 'Jedai Bunga Holo',
            'description' => 'Jedai bunga dengan efek hologram',
            'image' => '06.jpg',
            'seller_id' => 1,
            'category' => 'Jedai'
        ]);
        foreach (['Pink', 'Putih', 'Biru'] as $var) {
            ProductVariant::create(['product_id' => $p6->id, 'variant_name' => $var, 'price' => 9000, 'stock' => 10]);
        }

        $p7 = Product::create([
            'name' => 'Jedai Bunga Marble',
            'description' => 'Jedai bunga motif marble, unik dan kekinian',
            'image' => '07.jpg',
            'seller_id' => 1,
            'category' => 'Jedai'
        ]);
        foreach (['Biru', 'Pink', 'Cream'] as $var) {
            ProductVariant::create(['product_id' => $p7->id, 'variant_name' => $var, 'price' => 9000, 'stock' => 10]);
        }

        $p8 = Product::create([
            'name' => 'Karet Jepang',
            'description' => 'Karet rambut ala Jepang, awet dan tidak melar',
            'image' => '08.jpg',
            'seller_id' => 1,
            'category' => 'Karet'
        ]);
        foreach (['Glossy', 'Mix Colour', 'Hitam'] as $var) {
            ProductVariant::create(['product_id' => $p8->id, 'variant_name' => $var, 'price' => 7000, 'stock' => 10]);
        }

        $p9 = Product::create([
            'name' => 'Jedai Holo',
            'description' => 'Jedai hologram dengan bentuk berbeda',
            'image' => '09.jpg',
            'seller_id' => 1,
            'category' => 'Jedai'
        ]);
        foreach (['Bentuk 1', 'Bentuk 2', 'Bentuk 3'] as $var) {
            ProductVariant::create(['product_id' => $p9->id, 'variant_name' => $var, 'price' => 8000, 'stock' => 10]);
        }

        $p10 = Product::create([
            'name' => 'Jepit Mini Kupu-kupu',
            'description' => 'Jepit rambut mini bentuk kupu-kupu, menggemaskan',
            'image' => '10.jpg',
            'seller_id' => 1,
            'category' => 'Jepit'
        ]);
        foreach (['Pink', 'Putih', 'Biru'] as $var) {
            ProductVariant::create(['product_id' => $p10->id, 'variant_name' => $var, 'price' => 2000, 'stock' => 10]);
        }
    }
}