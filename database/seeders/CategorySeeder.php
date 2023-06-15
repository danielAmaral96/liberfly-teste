<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        
        Category::truncate();


        Schema::enableForeignKeyConstraints();
        $categories = [
            'Categoria 1',
            'Categoria 2',
            'Categoria 3',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}