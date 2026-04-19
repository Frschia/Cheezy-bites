<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
{
    $user = User::where('email', 'user@gmail.com')->first();

    if (!$user) return;

    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    OrderItem::truncate();
    Order::truncate();

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        /*
        |--------------------------------------------------------------------------
        | ORDER 1 - PENDING
        |--------------------------------------------------------------------------
        */
        $order1 = Order::create([
            'user_id' => $user->id,
            'nama' => 'Cia User',
            'email' => 'user@gmail.com',
            'phone' => '08123456789',
            'alamat' => 'Banjar, Jawa Barat',
            'metode' => 'Antar ke rumah',
            'total' => 30000,
            'status' => 'pending',
            'keterangan' => 'Menunggu pembayaran'
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => 1,
            'nama_produk' => 'Matcha',
            'gambar' => 'matcha.jpg',
            'harga' => 15000,
            'qty' => 2
        ]);

        /*
        |--------------------------------------------------------------------------
        | ORDER 2 - PROCESS
        |--------------------------------------------------------------------------
        */
        $order2 = Order::create([
            'user_id' => $user->id,
            'nama' => 'Cia User',
            'email' => 'user@gmail.com',
            'phone' => '08123456789',
            'alamat' => 'Banjar, Jawa Barat',
            'metode' => 'Ambil ke seller',
            'total' => 35000,
            'status' => 'process',
            'keterangan' => 'Sedang dibuat'
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => 2,
            'nama_produk' => 'Coklat',
            'gambar' => 'coklat.jpg',
            'harga' => 20000,
            'qty' => 1
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => 3,
            'nama_produk' => 'Original',
            'gambar' => 'original.jpg',
            'harga' => 15000,
            'qty' => 1
        ]);

        /*
        |--------------------------------------------------------------------------
        | ORDER 3 - SUCCESS
        |--------------------------------------------------------------------------
        */
        $order3 = Order::create([
            'user_id' => $user->id,
            'nama' => 'Cia User',
            'email' => 'user@gmail.com',
            'phone' => '08123456789',
            'alamat' => 'Banjar, Jawa Barat',
            'metode' => 'Janjian di tempat',
            'total' => 45000,
            'status' => 'success',
            'keterangan' => 'Pesanan selesai'
        ]);

        OrderItem::create([
            'order_id' => $order3->id,
            'product_id' => 4,
            'nama_produk' => 'Tiramisu',
            'gambar' => 'tiramishu.jpg',
            'harga' => 15000,
            'qty' => 3
        ]);

        /*
        |--------------------------------------------------------------------------
        | ORDER 4 - CANCEL
        |--------------------------------------------------------------------------
        */
        $order4 = Order::create([
            'user_id' => $user->id,
            'nama' => 'Cia User',
            'email' => 'user@gmail.com',
            'phone' => '08123456789',
            'alamat' => 'Banjar, Jawa Barat',
            'metode' => 'Antar ke rumah',
            'total' => 20000,
            'status' => 'cancel',
            'keterangan' => 'Dibatalkan karena ubah varian'
        ]);

        OrderItem::create([
            'order_id' => $order4->id,
            'product_id' => 2,
            'nama_produk' => 'Coklat',
            'gambar' => 'coklat.jpg',
            'harga' => 20000,
            'qty' => 1
        ]);
    }
}