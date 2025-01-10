<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Avatar::create([
            'name' => '2D Avatar',
            'price' => 50,
            'image_url' => 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/%E2%80%94Pngtree%E2%80%94web%20page%20ui%20default%20avatar_3801746.png?alt=media&token=5110a0bd-4fbe-405f-9a0f-c6b40edc3031'
        ]);

        Avatar::create([
            'name' => '3D Avatar',
            'price' => 500,
            'image_url' => 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/aazjeprd6.png?alt=media&token=e0359fe9-0228-462d-9e5a-8de939f82cf0'
        ]);

        Avatar::create([
            'name' => 'Anime 4K Avatar',
            'price' => 100000,
            'image_url' => 'https://firebasestorage.googleapis.com/v0/b/vinie-44385.appspot.com/o/exp.jpg?alt=media&token=2cc5baef-dc95-4702-aba1-3398c1405839'
        ]);
    }
}
