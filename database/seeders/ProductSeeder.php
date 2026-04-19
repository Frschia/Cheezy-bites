<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'nama' => 'Original',
            'harga' => 10000,
            'deskripsi' => 'Rasa Gurih Dan Lezat Dari Keju Akan Membuat Lidah Kamu Terus Ingin Merasakan Kenikmatan Yang Tiada Tanding',
            'gambar' => 'original.jpg',
            'stok' => 15
        ]);

        Product::create([
            'nama' => 'Coklat',
            'harga' => 10000,
            'deskripsi' => 'Rasa Coklat Manis Yang Dipadukan Dengan Rasa Gurih Dan Nikmat Dari Keju Yang Akan Membuat Ketagihan Di Setiap Gigitan',
            'gambar' => 'coklat.jpg',
            'stok' => 15
        ]);

        Product::create([
            'nama' => 'Tiramishu',
            'harga' => 10000,
            'deskripsi' => 'Rasa Kopi Tiramishu Yang Dipadukan Dengan Gurihnya Keju Akan Membuat Kamu Ingin Lagi, Lagi Dan Lagi',
            'gambar' => 'tiramishu.jpg',
            'stok' => 15
        ]);

        Product::create([
            'nama' => 'Matcha',
            'harga' => 10000,
            'deskripsi' => 'Paduan Rasa Matcha yang manis, Disertai Dengan Keju Yang Gurih Akan Membuat Kamu Tidak Bisa Berhenti Dan ingin Lagi !',
            'gambar' => 'matcha.jpg',
            'stok' => 15
        ]);
    }
}