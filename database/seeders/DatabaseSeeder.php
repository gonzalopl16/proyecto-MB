<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');

        Storage::makeDirectory('products');

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Luis Gonzalo',
            'email' => 'renovado16@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $this->call([
            FamilySeeder::class
        ]);

        Product::factory(150)->create();
    }
}
