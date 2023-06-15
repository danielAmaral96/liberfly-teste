<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Illuminate\Support\Facades\Schema;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Author::truncate();
        Schema::enableForeignKeyConstraints();
        
        $authorNames = [
            'Autor 1',
            'Autor 2',
            'Autor 3',
            
        ];

        
        foreach ($authorNames as $name) {
            Author::create([
                'name' => $name,
            ]);
        }
    }
}