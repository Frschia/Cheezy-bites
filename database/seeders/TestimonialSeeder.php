<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use App\Models\User;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $user1 = User::where('email', 'user@gmail.com')->first();

        Testimonial::truncate();

        Testimonial::create([
            'user_id' => $user1->id,
            'rating' => 5,
            'pesan' => 'Cheezy bites original enak banget, kejunya lumer!',
            'balasan_admin' => 'Terima kasih kak 💙 ditunggu order berikutnya.'
        ]);
    }
}