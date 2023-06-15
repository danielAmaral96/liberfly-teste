<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{
    Book,
    Author,
    Category
};
use Illuminate\Support\Facades\Schema;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::truncate();

        $authors = Author::all();
        $categories = Category::all();

        for ($i = 0; $i < 10; $i++) {
            $author = $authors->random();
            $category = $categories->random();

            Book::create([
                'name' => 'Livro ' . ($i + 1),
                'author_id' => $author->id,
                'category_id' => $category->id,
                'description' => 'Uma descrição legal'
            ]);
        }
    }
}