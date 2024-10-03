<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([
            [
                'title' => 'Note 1',
                'description' => 'Description of note 1',
                'creation_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addDays(10),
                'image_uri' => null,
                'user_id' => 1,
                'tag_id' => 1
            ],
            [
                'title' => 'Note 2',
                'description' => 'Description of note 2',
                'creation_date' => Carbon::now(),
                'expiration_date' => null,
                'image_uri' => null,
                'user_id' => 1,
                'tag_id' => 1
            ],
            [
                'title' => 'Note 3',
                'description' => 'Description of note 3',
                'creation_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addDays(15),
                'image_uri' => null,
                'user_id' => 1,
                'tag_id' => 1
            ],
            [
                'title' => 'Note 4',
                'description' => 'Description of note 4',
                'creation_date' => Carbon::now(),
                'expiration_date' => null,
                'image_uri' => null,
                'user_id' => 1,
                'tag_id' => 1
            ],
            [
                'title' => 'Note 5',
                'description' => 'Description of note 5',
                'creation_date' => Carbon::now(),
                'expiration_date' => Carbon::now()->addDays(5),
                'image_uri' => null,
                'user_id' => 1,
                'tag_id' => 1
            ],
        ]);
    }
}
