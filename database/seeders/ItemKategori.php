<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Kategori;
use Faker\Factory as Faker;

class ItemKategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Seed Kategori Table
        $kategoris = [
            'Makanan',
            'Minuman',
            'Obat-obatan',
            'Olahraga',
            'Kendaraan',
            'Elektronik',
            'Kesehatan',
            'Furniture',
            'Lainnya',
        ];
        
        $kategoriIds = [];

        foreach ($kategoris as $kategori) {
            $kategoriModel = Kategori::create([
                'nama' => $kategori,
            ]);
            $kategoriIds[] = $kategoriModel->id;
        }

        // Seed Item Table and attach Kategori
        foreach (range(1, 100) as $index) {
            $item = Item::create([
                'nama' => $faker->name,
                'harga' => $faker->numberBetween(1000, 10000000),
                'stok' => $faker->numberBetween(0, 500),
                'deskripsi' => $faker->paragraph,
            ]);

            // Assign 1 to 3 random categories to each book
            $randomKategoriIds = $faker->randomElements($kategoriIds, $faker->numberBetween(1, count($kategoris)));
            $item->kategoris()->attach($randomKategoriIds);
        }
    }
}
