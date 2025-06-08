<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada categories yang tersedia
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $this->command->error('Tidak ada categories! Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        // Ambil ID categories yang sudah ada
        $categoryIds = $categories->pluck('id')->toArray();

        // Buat news dengan category_id yang sudah ada
        News::factory(20)->create([
            'category_id' => function() use ($categoryIds) {
                return $categoryIds[array_rand($categoryIds)];
            }
        ]);

        // Buat beberapa news khusus
        $customNews = [
            [
                'title' => 'Revolusi Pembelajaran Online di Era Digital',
                'slug' => 'revolusi-pembelajaran-online-era-digital',
                'excerpt' => 'Bagaimana teknologi mengubah cara kita belajar dan mengajar di era digital ini.',
                'content' => 'Era digital telah membawa perubahan besar dalam dunia pendidikan. Pembelajaran online kini menjadi pilihan utama bagi banyak institusi pendidikan di seluruh dunia. Dengan berbagai platform pembelajaran yang tersedia, siswa dapat mengakses materi pelajaran kapan saja dan di mana saja.

Teknologi telah memungkinkan terciptanya lingkungan belajar yang lebih interaktif dan engaging. Video pembelajaran, simulasi virtual, dan gamifikasi menjadi tools yang semakin populer digunakan oleh para educator.

Namun, tantangan juga muncul dalam implementasi pembelajaran online. Infrastruktur teknologi, literasi digital, dan motivasi belajar siswa menjadi faktor-faktor penting yang perlu diperhatikan.',
                'author' => 'Dr. Ahmad Santoso',
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'category_id' => Category::where('name', 'LIKE', '%Teknologi%')->first()?->id ?? $categoryIds[0]
            ],
            [
                'title' => 'Tips Memilih Platform E-Learning yang Tepat',
                'slug' => 'tips-memilih-platform-elearning-tepat',
                'excerpt' => 'Panduan lengkap memilih platform pembelajaran online yang sesuai dengan kebutuhan Anda.',
                'content' => 'Memilih platform e-learning yang tepat adalah langkah penting dalam kesuksesan pembelajaran online. Ada beberapa faktor yang perlu dipertimbangkan dalam memilih platform yang sesuai.

Pertama, pastikan platform tersebut user-friendly dan mudah digunakan. Interface yang kompleks dapat menghambat proses pembelajaran. Kedua, fitur-fitur yang tersedia harus sesuai dengan kebutuhan pembelajaran Anda.

Ketiga, perhatikan sistem support dan customer service yang disediakan. Platform yang baik harus memiliki tim support yang responsif. Terakhir, pertimbangkan juga aspek biaya dan value yang ditawarkan.',
                'author' => 'Prof. Sari Wulandari',
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'category_id' => Category::where('name', 'LIKE', '%E-Learning%')->first()?->id ?? $categoryIds[0]
            ],
            [
                'title' => 'Masa Depan Kursus Online di Indonesia',
                'slug' => 'masa-depan-kursus-online-indonesia',
                'excerpt' => 'Prospek dan tantangan pengembangan kursus online di Indonesia.',
                'content' => 'Indonesia memiliki potensi besar dalam pengembangan kursus online. Dengan populasi yang besar dan akses internet yang semakin luas, kursus online menjadi solusi pendidikan yang menjanjikan.

Pemerintah juga mulai mendukung digitalisasi pendidikan melalui berbagai program dan inisiatif. Hal ini membuka peluang besar bagi para educator dan institusi pendidikan untuk mengembangkan platform pembelajaran online yang berkualitas.',
                'author' => 'Budi Santoso',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'category_id' => Category::where('name', 'LIKE', '%Kursus%')->first()?->id ?? $categoryIds[0]
            ]
        ];

        foreach ($customNews as $newsData) {
            News::firstOrCreate(
                ['slug' => $newsData['slug']],
                $newsData
            );
        }

        $this->command->info('NewsSeeder berhasil dijalankan!');
    }
}