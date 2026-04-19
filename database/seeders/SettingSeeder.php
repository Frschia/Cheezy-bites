<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([
            'whatsapp'  => '0857-9866-5939',
            'instagram' => 'cheezybites99',
            'jam'       => '09.00 - 21.00 WIB',
            'lokasi'    => 'STMIK Mardira Indonesia'
        ]);
    }
}