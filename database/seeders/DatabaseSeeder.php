<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::truncate();
        \App\Models\Product::truncate();

        Storage::disk('public')->deleteDirectory('images/products');
        Storage::disk('public')->makeDirectory('images/products');

        \App\Models\User::factory(1)->create([
            'email' => 'user@test.test'
        ]);

        \App\Models\Product::factory(25)->create();
    }
}
