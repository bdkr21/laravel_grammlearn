<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 'Item 1',
            'description' => 'Deskripsi item 1',
            'price' => 100,
            'image' => 'url_gambar_1', // URL gambar contoh
        ]);

        Item::create([
            'name' => 'Item 2',
            'description' => 'Deskripsi item 2',
            'price' => 200,
            'image' => 'url_gambar_2', // URL gambar contoh
        ]);

        Item::create([
            'name' => 'Item 3',
            'description' => 'Deskripsi item 3',
            'price' => 300,
            'image' => 'url_gambar_3', // URL gambar contoh
        ]);
    }
}
