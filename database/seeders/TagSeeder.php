<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'name' => 'Trabajo'
        ]);
        Tag::create([
            'name' => 'Personal'
        ]);
        Tag::create([
            'name' => 'Interpersonal'
        ]);
        Tag::create([
            'name' => 'Educacion'
        ]);
        Tag::create([
            'name' => 'Salud'
        ]);
    }
}
