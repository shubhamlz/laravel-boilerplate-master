<?php

namespace Database\Seeders;
use App\Domains\Auth\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'cat_name' => 'Mobile',
            'cat_description' => 'Mobile appliances',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            'cat_name' => 'Laptop',
            'cat_description' => 'Mobile appliances',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
