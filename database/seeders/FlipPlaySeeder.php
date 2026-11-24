<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;

class FlipPlaySeeder extends Seeder
{
    public function run(): void
    {
        $this->createDefaultUser();
        $this->createDefaultMedia();
    }

    private function createDefaultUser(): void
    {
        User::updateOrCreate(
            ['code' => 'USR001'],
            [
                'name' => 'Rosyad',
                'email' => 'rosyad@flipplay.test',
                'password' => 'password',
            ]
        );
    }

    private function createDefaultMedia(): void
    {
        $mediaItems = [
            [
                'id' => 'ANI001',
                'title' => "Frieren: Beyond Journey's End",
                'creator' => 'Kanehito Yamada',
                'release_year' => 2023,
                'description' => 'Petualangan penyihir elf setelah perjalanan kelompok pahlawan berakhir.',
                'type' => 'Anime',
                'episode_count' => 28,
                'studio' => 'Madhouse',
                'volume_count' => null,
                'publisher' => null,
            ],
            [
                'id' => 'ANI002',
                'title' => 'Spy x Family',
                'creator' => 'Tatsuya Endo',
                'release_year' => 2022,
                'description' => 'Kisah keluarga palsu yang menjalankan misi rahasia masing-masing.',
                'type' => 'Anime',
                'episode_count' => 25,
                'studio' => 'Wit Studio dan CloverWorks',
                'volume_count' => null,
                'publisher' => null,
            ],
            [
                'id' => 'MAN001',
                'title' => 'Blue Lock',
                'creator' => 'Muneyuki Kaneshiro',
                'release_year' => 2018,
                'description' => 'Kompetisi untuk membentuk striker terbaik Jepang.',
                'type' => 'Manga',
                'episode_count' => null,
                'studio' => null,
                'volume_count' => 30,
                'publisher' => 'Kodansha',
            ],
            [
                'id' => 'MAN002',
                'title' => 'Spy x Family',
                'creator' => 'Tatsuya Endo',
                'release_year' => 2019,
                'description' => 'Manga tentang keluarga yang menyimpan identitas rahasia.',
                'type' => 'Manga',
                'episode_count' => null,
                'studio' => null,
                'volume_count' => 15,
                'publisher' => 'Shueisha',
            ],
            [
                'id' => 'LN001',
                'title' => 'Re:Zero - Starting Life in Another World',
                'creator' => 'Tappei Nagatsuki',
                'release_year' => 2014,
                'description' => 'Seorang pemuda menghadapi dunia baru dengan kemampuan mengulang waktu setelah kematian.',
                'type' => 'Light Novel',
                'episode_count' => null,
                'studio' => null,
                'volume_count' => 35,
                'publisher' => 'MF Bunko J',
            ],
            [
                'id' => 'LN002',
                'title' => 'Classroom of the Elite',
                'creator' => 'Syougo Kinugasa',
                'release_year' => 2015,
                'description' => 'Kehidupan siswa dalam sekolah yang menggunakan sistem persaingan dan poin.',
                'type' => 'Light Novel',
                'episode_count' => null,
                'studio' => null,
                'volume_count' => 11,
                'publisher' => 'MF Bunko J',
            ],
        ];

        foreach ($mediaItems as $item) {
            Media::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }
    }
}