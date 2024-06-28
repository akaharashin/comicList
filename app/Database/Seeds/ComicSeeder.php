<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ComicSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Berserk',
                'slug' => 'berserk', 
                'author' => 'Kentaro Miura',
                'mangaLabel' => 'Hakusensha',
                'genre' => 'Seinen, Dark Fantasy',
                'cover' => 'berserk.jpg'
            ],
            [
                'title' => 'Vinland Saga',
                'slug' => 'vinland-saga', 
                'author' => 'Makoto Yukimura',
                'mangaLabel' => 'Shounen Jump',
                'genre' => 'Seinen, Action',
                'cover' => 'vinland.jpg'
            ],
            [
                'title' => 'Steel Ball Run',
                'slug' => 'steel-ball-run', 
                'author' => 'Hirohiko Araki',
                'mangaLabel' => 'Shounen Jump',
                'genre' => 'Adventure, Action',
                'cover' => 'jojo7.jpg'
            ],
        ];

        $this->db->table('comics')->insertBatch($data);
    }


}
