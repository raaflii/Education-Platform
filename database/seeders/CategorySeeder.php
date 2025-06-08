<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table to avoid duplicates (optional)
        // Category::truncate();

        $categories = [
            [
                'name' => 'Teknologi Pendidikan',
                'description' => 'Berita seputar perkembangan teknologi dalam dunia pendidikan'
            ],
            [
                'name' => 'E-Learning',
                'description' => 'Informasi terkini tentang pembelajaran elektronik dan platform online'
            ],
            [
                'name' => 'Inovasi Edukasi',
                'description' => 'Berbagai inovasi dan terobosan baru dalam bidang pendidikan'
            ],
            [
                'name' => 'Digital Learning',
                'description' => 'Pembelajaran digital dan transformasi pendidikan era modern'
            ],
            [
                'name' => 'Kursus Online',
                'description' => 'Informasi seputar kursus-kursus online dan pembelajaran jarak jauh'
            ]
        ];

        foreach ($categories as $categoryData) {
            $slug = Str::slug($categoryData['name']);
            
            // Check if category with this slug already exists
            $existingCategory = Category::where('slug', $slug)->first();
            
            if (!$existingCategory) {
                Category::create(array_merge($categoryData, ['slug' => $slug]));
            } else {
                // Update existing category if needed
                $existingCategory->update($categoryData);
            }
        }
    }
}